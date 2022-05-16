<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\Test;

class WebPushController extends Controller
{
    // WebPushを登録する
    public function subscribe(Request $request)
    {
        $user = User::find(Auth::id());

        $user->updatePushSubscription(
            $request->post('endpoint'),
            $request->post('public_key'),
            $request->post('auth_token'),
            $request->post('encoding'),
        );
        return response()->json(['message' => '通知をオンにしました']);
    }

    // WebPush登録を解除する
    public function unsubscribe(Request $request)
    {
        $user = User::find(Auth::id());

        $user->deletePushSubscription($request->post('endpoint'));

        return response()->json(['message' => '通知をオフにしました']);
    }
}
