<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\DM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AccountDeleteController extends Controller
{
    // アカウント削除を実行した時(Post)
    public function AccountDelete(Request $request)
    {
        // 入力したパスワードをリクエスト
        $password = $request->password;
        
        // 現在のユーザを獲得
        $user = Auth::user();

        // ユーザーのidを獲得
        $user_id = $user->id;
        
        // 情報を獲得
        $userd = User::where("id", $user->id)->first();
        $posts = Post::where('user_id', $user_id)->get();
        $replies = Reply::where('user_id', $user_id)->get();
        // DMはユーザ1とユーザ2の中にそのユーザIDが含まれていた場合
        $dms = DM::where('user1', $user_id)->orwhere('user2', $user_id)->get();

        // 現在のパスワードと入力したパスワードをハッシュで確認
        if (Hash::check($password, $user->password)) {
            //もしパスワードがあっていれば

            Storage::delete("profile/$user_id/$user->avatar");
            
            // 投稿を削除
            foreach ($posts as $post) {
                Storage::delete("$user_id/$post->file");
                $post->delete();
            }

            // リプライを削除
            foreach ($replies as $reply) {
                Storage::delete("$user_id/$reply->file");
                $reply->delete();
            }

            // DMを削除
            foreach ($dms as $dm) {
                Storage::delete("dm/$dm->room_id/$dm->file");
                $dm->delete();
            }

            // ユーザを削除
            $userd->delete();

            // リダイレクト
            return redirect()->route('index')->with('success', 'アカウント削除完了！');
        } else {
            // パスワードが一致しない場合
            // メッセージを表示
            return redirect()->route('index')->with('error', 'パスワードが一致しません');
        }
    }
}
