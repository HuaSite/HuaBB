<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\DM;
use App\Models\LikePost;
use App\Notifications\EveryonePost;
use App\Notifications\LikeNotice;
use App\Notifications\ReplyNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use php_user_filter;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller
{
    // ホーム画面を表示
    public function index()
    {
        return view('posts.index');
    }

    // 投稿する画面を表示
    public function create()
    {
        return view('posts.create');
    }

    // 投稿を保存
    public function store(Request $request)
    {
        $ids = Auth::id();
        $user_avatar = Auth::user()->avatar;
        $username = Auth::user()->name;
        $user_idname = Auth::user()->user_id;
        // everyoneのチェックの有無を獲得
        if ($request->everyone == true) {
            $everyone = 1;
        } else if ($request->everyone == false) {
            $everyone = 0;
        }
        // ファイルがもしあれば保存する
        $filed = $request->file('file');
        if (!empty($filed)) {
            $filename = $filed->getClientOriginalName();
            $filed->move("file/$ids", $filename);
        } else {
            $filename = "";
        }

        // データベースを保存する
        Post::create([
            'user_id' => $ids,
            'username' => $username,
            'user_idname' => $user_idname,
            'user_avatar' => $user_avatar,
            'everyone' => $everyone,
            'title' => $request->title,
            'body' => $request->body,
            'notification' => 1,
            'file' => $filename,
        ]);
        // everyoneがオンの時に通知を送る
        if ($request->everyone == true) {
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new EveryonePost($username, $request->title));
            }
        }
        session()->flash('success', '投稿完了');
        return redirect()->route('index');
    }
    // 投稿を表示
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post_id = $post->id;
        $reply = Reply::where('post_id', $post_id)->get();
        $user_id = $post->user_id;
        $user = User::where('id', $user_id)->first();
        $likepost = LikePost::where('post_id', $post_id)->get();

        return view('posts.detail', [$user_id, 'post' => $post, 'reply' => $reply, 'user' => $user, 'likepost' => $likepost]);
    }
    // 投稿編集画面の表示
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->user()->id != $post->user_id) {
            session()->flash('error', '他人の投稿を編集することはできないよ？');
            return redirect()->route('index');
        }
        return view('posts.edit', ['post' => $post]);
    }
    // 投稿を編集したものをアップデート
    public function update(Request $request)
    {
        $id = $request->post_id;
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        session()->flash('success', '更新完了');
        return redirect()->route('show', ['id' => $id]);
    }
    // 投稿を削除
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $idu = Auth::id();
        if (auth()->user()->id != $post->user_id) {
            session()->flash('error', '他人の投稿を削除することはできないよ？');
            return redirect(request()->header('Referer'));
        }
        Storage::delete("$idu/$post->file");
        $post->delete();

        session()->flash('success', '削除完了');
        return redirect()->route('index');
    }
    // 投稿にいいねする
    public function postlike(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $post = Post::where('id', $request->post_id)->first();
        $peeruser = User::where('id', $post->user_id)->first();
        $like = LikePost::where('post_id', $request->post_id)->where('id', Auth::id())->first();
        if (is_null($like)) {
            LikePost::create([
                'post_id' => $request->post_id,
                'user_id' => Auth::id()
            ]);
        } else {
            session()->flash('success', 'すでにいいねされています！');
            return redirect(request()->header('Referer'));
        }
        $peeruser->notify(new LikeNotice($user->name, $request->post_id));
        session()->flash('success', 'いいねしました！');
        return redirect(request()->header('Referer'));
    }
    // 投稿のいいねを解除する
    public function postunlike(Request $request)
    {
        $user = Auth::id();
        $like = LikePost::where('post_id', $request->post_id)->where('user_id', $user)->first();
        if (is_null($like)) {
            session()->flash('success', 'すでにいいね解除されています！');
            return redirect(request()->header('Referer'));
        }
        else
        {
            $like->delete();
        }
        session()->flash('success', 'いいねを解除しました！');
        return redirect(request()->header('Referer'));
    }
    // リプライを投稿
    public function replystore(Request $request)
    {
        $ids = Auth::id();
        $user_avatar = Auth::user()->avatar;
        $username = Auth::user()->name;
        $user_idname = Auth::user()->user_id;

        // ファイルがもしあれば保存する
        $filed = $request->file('file');
        if (!empty($filed)) {
            $filename = $filed->getClientOriginalName();
            $filed->move("file/$ids", $filename);
        } else {
            $filename = "";
        }

        // データベースを保存する
        Reply::create([
            'user_id' => $ids,
            'post_id' => $request->post_id,
            'reply_user_idname' => $request->reply_user_id,
            'username' => $username,
            'user_avatar' => $user_avatar,
            'user_idname' => $user_idname,
            'body' => $request->body,
            'notification' => 1,
            'file' => $filename,
        ]);

        $user = User::where('user_id', $request->reply_user_id)->first();

        // リプライしたユーザに通知を送る
        $user->notify(new ReplyNotice($username, $request->post_id));

        session()->flash('success', '返信完了');
        return redirect()->route('show', ['id' => $request->post_id]);
    }
    // リプライ編集画面の表示
    public function replyedit($id)
    {
        $rep = Reply::findOrFail($id);
        if (auth()->user()->id != $rep->user_id) {
            session()->flash('error', '他人の返信を編集することはできないよ？');
            return redirect()->route('show', ['id' => $rep->post_id]);
        }
        return view('posts.replyedit', ['rep' => $rep]);
    }
    // リプライを編集したものをアップデート
    public function replyupdate(Request $request)
    {
        $id = $request->rep_id;
        $rep = Reply::findOrFail($id);
        $rep->body = $request->body;
        $rep->save();

        session()->flash('updatesuccess', '更新完了');
        return redirect()->route('show', ['id' => $rep->post_id]);
    }
    // リプライを削除
    public function replydestroy($id)
    {
        $rep = Reply::findOrFail($id);
        $idu = Auth::id();
        if (auth()->user()->id != $rep->user_id) {
            session()->flash('deleteerror', '他人の返信を削除することはできないよ？');
            return redirect()->route('index');
        }
        Storage::delete("$idu/$rep->file");
        $rep->delete();

        session()->flash('deletesuccess', '削除完了');
        return redirect(request()->header('Referer'));
    }
    // マイページを表示
    public static function mypage()
    {
        $id = Auth::id();
        $user = Auth::user();
        return view('posts.mypage', [$id, 'user' => $user]);
    }
    // アイコン画像を更新
    public function myprofile(Request $request)
    {
        $user_id = Auth::id();
        $databaseinsert = User::where('id', $user_id)->first();
        $postinserts = Post::where('user_id', $user_id)->get();
        $replyinserts = Reply::where('user_id', $user_id)->get();
        $dminserts = DM::where('dm_user_id', $user_id)->get();
        Storage::delete("profile/$user_id/$databaseinsert->avatar");
        $avatar = $request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->storeAs("profile/$user_id", $avatar);
        $databaseinsert->avatar = $avatar;
        $databaseinsert->save();
        foreach ($postinserts as $postinsert) {
            $postinsert->user_avatar = $avatar;
            $postinsert->save();
        }
        foreach ($replyinserts as $replyinsert) {
            $replyinsert->user_avatar = $avatar;
            $replyinsert->save();
        }
        foreach ($dminserts as $dminsert) {
            $dminsert->user_avatar = $avatar;
            $dminsert->save();
        }

        session()->flash('profilesuccess', 'プロフィール画像更新完了');
        return redirect()->route('mypage');
    }
    // プロフィールを編集
    public function profiletextupdate(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->profile = $request->profile;
        $user->save();
        session()->flash('profilesuccess', 'プロフィール更新完了');
        return redirect()->route('mypage');
    }
    // リプライ自体を表示
    public function replyshow($id)
    {
        $rep = Reply::findOrFail($id);
        $user_id = $rep->user_id;
        $user = User::where('id', $user_id)->first();

        return view('posts.replydetail', [$user_id, 'rep' => $rep, 'user' => $user]);
    }
    // 検索機能
    public function search(Request $request)
    {
        $keyword_name = $request->name;
        $keyword_title = $request->title;
        $keyword_body = $request->body;

        return view('posts.search', ['keyword_name' => $keyword_name, 'keyword_title' => $keyword_title, 'keyword_body' => $keyword_body]);
    }
    // プロフィールを表示
    public function profile($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        return view('posts.profile', ['user_id' => $user_id, 'user' => $user]);
    }
    // 通知を表示
    public function notice()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('posts.notice', [$id, 'user' => $user]);
    }
}
