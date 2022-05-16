<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use php_user_filter;

class DMController extends Controller
{
    // DMの検索画面を表示
    public function dmhome()
    {
        // DMの検索画面を表示
        return view('dm.dmhome');
    }
    // dmを検索(Post)
    public function dmsearch(Request $request)
    {
        // インプットした値を獲得
        $keyword_name = $request->name;
        $keyword_idname = $request->idname;

        // 検索機能
        if ($keyword_name == "*" || $keyword_idname == "*") {
            $users = User::all();
            $message = "すべてのユーザーを表示します。";
            return view('dm.dmsearch')->with([
                'users' => $users,
                'message' => $message,
            ]);
        } else if (!empty($keyword_name) && empty($keyword_idname)) {
            $query = User::query();
            $users = $query->where('name', 'like', '%' . $keyword_name . '%')->orderBy('id', 'desc')->get();
            $message = "「" . $keyword_name . "」" . "を含む検索結果";
            return view('dm.dmsearch')->with([
                'users' => $users,
                'message' => $message,
            ]);
        } else if (empty($keyword_name) && !empty($keyword_idname)) {
            $query = User::query();
            $users = $query->where('user_id', 'like', '%' . $keyword_idname . '%')->orderBy('id', 'desc')->get();
            $message = "「" . $keyword_idname . "」" . "を含む検索結果";
            return view('dm.dmsearch')->with([
                'users' => $users,
                'message' => $message,
            ]);
        } else if (!empty($keyword_name) && !empty($keyword_idname)) {
            $query = User::query();
            $users = $query->where('name', 'like', '%' . $keyword_name . '%')->where('user_id', 'like', '%' . $keyword_idname . '%')->orderBy('id', 'desc')->get();
            $message = "「" . $keyword_name . "」" . "と" . "「" . $keyword_idname . "」" . "を含む検索結果";
            return view('dm.dmsearch')->with([
                'users' => $users,
                'message' => $message,
            ]);
        } else if (empty($keyword_name) && empty($keyword_idname)) {
            $message = "何かを入力してください。";
            return view('dm.dmsearch')->with('message', $message);
        } else {
            $message = "検索結果はありません。";
            return view('dm.dmsearch')->with('message', $message);
        }
    }
    public function dm($user_id, $user_id2)
    {
        // 現在のユーザidを獲得
        $myuser_id = Auth::id();

        // ルームIDを獲得
        if ($myuser_id == $user_id2) {
            $peeruser = User::where('id', $user_id)->first();
            if ($user_id2 > $user_id) {
                $dms = DM::where('room_id', $user_id2 . "and" . $user_id)->orderBy('id', 'desc')->get();
            } else {
                $dms = DM::where('room_id', $user_id . "and" . $user_id2)->orderBy('id', 'desc')->get();
            }
        } else if ($myuser_id == $user_id) {
            $peeruser = User::where('id', $user_id2)->first();
            if ($user_id2 > $user_id) {
                $dms = DM::where('room_id', $user_id2 . "and" . $user_id)->orderBy('id', 'desc')->get();
            } else {
                $dms = DM::where('room_id', $user_id . "and" . $user_id2)->orderBy('id', 'desc')->get();
            }
        }
        return view('dm.dm', ['peeruser' => $peeruser, 'dms' => $dms, 'myuser_id' => $myuser_id, 'user_id' => $user_id, 'user_id2' => $user_id2]);
    }
}
