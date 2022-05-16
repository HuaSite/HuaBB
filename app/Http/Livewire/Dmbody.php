<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\DM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use php_user_filter;

class Dmbody extends Component
{
    public $user_id;
    public $user_id2;

    public $myuser_id;
    public $peeruser_id;
    public $dms;

    public $deleteopen = false;

    public $deletedmid;

    // DMをリロード
    public function dmreload()
    {
        $this->myuser_id = Auth::id();
        if ($this->myuser_id == $this->user_id2) {
            $this->peeruser_id = User::where('id', $this->user_id)->first();
            if ($this->user_id2 > $this->user_id) {
                $this->dms = DM::where('room_id', $this->user_id2 . "and" . $this->user_id)->orderBy('id', 'desc')->get();
            } else {
                $this->dms = DM::where('room_id', $this->user_id . "and" . $this->user_id2)->orderBy('id', 'desc')->get();
            }
        } else if ($this->myuser_id == $this->user_id) {
            $this->peeruser_id = User::where('id', $this->user_id2)->first();
            if ($this->user_id2 > $this->user_id) {
                $this->dms = DM::where('room_id', $this->user_id2 . "and" . $this->user_id)->orderBy('id', 'desc')->get();
            } else {
                $this->dms = DM::where('room_id', $this->user_id . "and" . $this->user_id2)->orderBy('id', 'desc')->get();
            }
        }
    }

    // dmの削除のダイアログを表示
    public function opendeletedialog($id)
    {
        $this->deleteopen = true;
        $this->deletedmid = $id;
    }

    // dmの削除のダイアログを閉じる
    public function closedeletedialog()
    {

        $this->deleteopen = false;
    }

    // dmを削除
    public function dmdestroy()
    {
        $dm = DM::findOrFail($this->deletedmid);
        $idu = Auth::id();
        if ($idu != $dm->dm_user_id) {
            return redirect(request()->header('Referer'));
        }
        Storage::delete("dm/$dm->room_id/$dm->file");
        $dm->delete();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        $this->dmreload();
        return view('livewire.dmbody', ['peeruser_id' => $this->peeruser_id, 'dms' => $this->dms, 'myuser_id' => $this->myuser_id, 'user_id' => $this->user_id, 'user_id2' => $this->user_id2, 'deleteopen' => $this->deleteopen]);
    }
}
