<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostList extends Component
{

    public $postpage = 10;
    
    public function loadMore()
    {
        $this->postpage += 10;
    }

    public function render()
    {
        $posts = Post::orderBy('id', 'desc')->paginate($this->postpage, ["*"], 'post');
        return view('livewire.post-list', ['posts' => $posts]);
    }
}
