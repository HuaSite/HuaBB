<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use php_user_filter;

class AdminController extends Controller
{
    // 設定画面を表示
    public function setting()
    {
        // ユーザを獲得(ページネーション)
        $users = User::orderBy('id', 'desc')->paginate(5);
        // 設定画面を表示
        return view('admin.setting', ['users' => $users]);
    }

    // パーミッション設定をアップデート(Post)
    public function settingupdate(Request $request)
    {
        // ユーザを獲得(ページネーション)
        $users = User::orderBy('id', 'desc')->paginate(5);
        
        // inputで獲得したロールを表示
        foreach ($users as $user) {
            $userid = $user->id;
            $user->role = $request->$userid;
        }

        // 保存
        foreach ($users as $user) {
            $user->save();
        }

        // リダイレクト
        return redirect()->route('setting')->with('success', '更新完了');
    }

    // トップ画面をアップデート(Post)
    public function settingimageupdate(Request $request)
    {
        // 画像を置く
        if (!$request->file('topimage') == null) {
            Storage::disk('site')->putFileAs('', $request->file('topimage'), 'HuaBB.svg');
        }
        $topsize = $request->topsize;
        $path = base_path('.env');

        // 画像サイズも変更
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'TopImageSize=' . config('topimagesize.size'),
                'TopImageSize=' . $topsize,
                    file_get_contents($path)
            ));
        }

        // 更新
        return redirect()->route('setting')->with('success', '更新完了');
    }
    // webサイト名をアップデート(Post)
    public function settingappnameupdate(Request $request)
    {
        // 入力したサイト名をアップロードして、.envに書き込む
        $setname = $request->setname;
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'APP_NAME=' . config('app.name'),
                'APP_NAME=' . $setname,
                    file_get_contents($path)
            ));
        }

        // リダイレクト
        return redirect()->route('setting')->with('success', '更新完了');
    }
    // デバッグのオンオフの設定(Post)
    public function settingdebugupdate(Request $request)
    {
        // 獲得した数値をsetdebug変数に入れる
        $setdebug = $request->setdebug;
        
        // app.debugの値を獲得
        if(config('app.debug') == 0)
        {
            $configdebug = 'false';
        }
        else if(config('app.debug') == 1)
        {
            $configdebug = 'true';
        }

        // APP_DEBUGの値を置き換え
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'APP_DEBUG=' . $configdebug,
                'APP_DEBUG=' . $setdebug,
                    file_get_contents($path)
            ));
        }

        // リダイレクト
        return redirect()->route('setting')->with('success', '更新完了');
    }
}
