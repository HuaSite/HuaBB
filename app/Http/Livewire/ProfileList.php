<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;

class ProfileList extends Component
{
    public $perPagePost = 10;
    public $perPageReply = 10;

    public $user_id;
    

    public function loadMorePost()
    {
        $this->perPagePost += 10;
    }

    public function loadMoreReply()
    {
        $this->perPageReply += 10;
    }
    
    public function render()
    {
        $user = User::where('user_id', $this->user_id)->first();
        $posts = Post::where('user_idname', $this->user_id)->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts')->appends(["reply" => \Request::get('reply')]);
        $reply = Reply::where('user_idname', $this->user_id)->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply')->appends(["posts" => \Request::get('posts')]);
        return view('livewire.profile-list', ['user_id' => $this->user_id, 'user' => $user, 'posts' => $posts, 'reply' => $reply]);
    }
}
