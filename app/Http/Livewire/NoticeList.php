<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class NoticeList extends Component
{
    public $perPagePost = 5;
    public $perPageReply = 5;

    public function loadMorePost()
    {
        $this->perPagePost += 5;
    }

    public function loadMoreReply()
    {
        $this->perPageReply += 5;
    }

    // 通知を表示
    public function render()
    {
        $user = Auth::user();
        $posts = Post::where('body', 'like', '%' . $user->user_id . '%')->where('user_id', '<>', Auth::id())->orWhere('title', 'like', '%' . $user->user_id . '%')->orWhere('everyone', 1)->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts')->appends(["reply" => \Request::get('reply')]);
        $reply = Reply::where('reply_user_idname', $user->user_id)->where('user_id', '<>', Auth::id())->orWhere('body', 'like', '%' . $user->user_id . '%')->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply')->appends(["posts" => \Request::get('posts')]);
        // 通知を確認
        foreach ($posts as $post) {
            $post->notification = 0;
            $post->save();
        }
        foreach ($reply as $rep) {
            $rep->notification = 0;
            $rep->save();
        }
        return view('livewire.notice-list', ['user' => $user, 'posts' => $posts, 'reply' => $reply]);
    }
}
