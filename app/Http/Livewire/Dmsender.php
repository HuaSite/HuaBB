<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\DM;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Notifications\DMNotice;
use php_user_filter;

class Dmsender extends Component
{
    use WithFileUploads;

    public $user_id;
    public $user_id2;
    
    public $dm_file;
    public $dm_body;

    public $peeruser_id;

    // フォームをリセットする
    public function resetForm()
    {
        $this->dm_body = '';
        $this->dm_file = null;
    }

    // フォームからdmを送る
    public function send()
    {
        $myuser = Auth::user();
        $myuser_avatar = $myuser->avatar;
        $myusername = $myuser->name;
        $myuser_id = $myuser->user_id;
        $myid = $myuser->id;

        $user = User::where('id', $this->peeruser_id)->first();
        $userid = $user->id;

        if ($myid > $userid) {
            $dmid = $myid . "and" . $userid;
        } else {
            $dmid = $userid . "and" . $myid;
        }
        
        $filed = $this->dm_file;
        if (!empty($filed)) {
            $filename = $filed->getClientOriginalName();
            $filed->storeAs("dm/$dmid", $filename);
        } else {
            $filename = "";
        }

        DM::create([
            'dm_user_id' => $myid,
            'dm_user_idname' => $myuser_id,
            'dm_username' => $myusername,
            'user_avatar' => $myuser_avatar,
            'room_id' => $dmid,
            'user1' => $myid,
            'user2' => $userid,
            'body' => $this->dm_body,
            'file' => $filename,
        ]);

        $user = User::where('id', $userid)->first();
        
        $user->notify(new DMNotice($myusername, $this->dm_body));

        $this->resetForm();
   
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        $myuser_id = Auth::id();
        if ($myuser_id == $this->user_id2) {
            $this->peeruser_id = $this->user_id;
        } else if ($myuser_id == $this->user_id) {
            $this->peeruser_id = $this->user_id2;
        }
        return view('livewire.dmsender', ['peeruser_id' => $this->peeruser_id, 'myuser_id' => $myuser_id]);
    }
}
