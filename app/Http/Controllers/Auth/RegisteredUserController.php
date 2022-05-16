<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $avaterfile = $request->file('avatar');
        if(!empty($avaterfile))
        {
            $avatar = $request->file('avatar')->getClientOriginalName();
        }
        else
        {
            $avatar = 'default.png';
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|string|max:50|unique:users',
            'avatar' => 'image',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'avatar' => $avatar,
            'password' => Hash::make($request->password),
        ]);
        if($avatar == 'default.png')
        {
            Storage::copy("profile/default.png", "profile/$user->id/$avatar");
        }
        else
        {
            $request->file('avatar')->storeAs("profile/$user->id", $avatar);
        }
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
