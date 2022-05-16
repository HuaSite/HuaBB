<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class MypageList extends Component
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
    public function render()
    {
        $id = Auth::id();
        $posts = Post::where('user_id', $id)->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts')->appends(["reply" => \Request::get('reply')]);
        $reply = Reply::where('user_id', $id)->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply')->appends(["posts" => \Request::get('posts')]);
        return view('livewire.mypage-list', [$id, 'posts' => $posts, 'reply' => $reply]);
    }
}
