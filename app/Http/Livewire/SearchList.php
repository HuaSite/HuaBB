<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Reply;

class SearchList extends Component
{
    public $perPagePost = 5;
    public $perPageReply = 5;

    public $keyword_name;
    public $keyword_title;
    public $keyword_body;

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

        if (!empty($this->keyword_name) && empty($this->keyword_title) && empty($this->keyword_body)) {
            $query = Post::query();
            $rquery = Reply::query();
            $posts = $query->where('username', 'like', '%' . $this->keyword_name . '%')->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts');
            $reply = $rquery->where('username', 'like', '%' . $this->keyword_name . '%')->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply');
            $message = "「" . $this->keyword_name . "」を含む名前の投稿の検索が完了しました。";
            session()->flash('info', $message);
            return view('livewire.search-list')->with([
                'posts' => $posts,
                'reply' => $reply,
            ]);
        } else if (empty($this->keyword_name) && !empty($this->keyword_title) && empty($this->keyword_body)) {
            $query = Post::query();
            $posts = $query->where('title', 'like', '%' . $this->keyword_title . '%')->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts');
            $message = "「" . $this->keyword_title . "」を含むタイトルの投稿の検索が完了しました。";
            session()->flash('info', $message);
            return view('livewire.search-list')->with([
                'posts' => $posts,
            ]);
        } else if (empty($this->keyword_name) && empty($this->keyword_title) && !empty($this->keyword_body)) {
            $query = Post::query();
            $rquery = Reply::query();
            $posts = $query->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts');
            $reply = $rquery->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply');
            $message = "「" . $this->keyword_body . "」を含む投稿の検索が完了しました。";
            session()->flash('info', $message);
            return view('livewire.search-list')->with([
                'posts' => $posts,
                'reply' => $reply,
            ]);
        } else if (!empty($this->keyword_name) && !empty($this->keyword_title) && empty($this->keyword_body)) {
            $query = Post::query();
            $rquery = Reply::query();
            $posts = $query->where('username', 'like', '%' . $this->keyword_name . '%')->where('title', 'like', '%' . $this->keyword_title . '%')->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts');
            $reply = $rquery->where('username', 'like', '%' . $this->keyword_name . '%')->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply');
            $message = "「" . $this->keyword_name . "」と、「" . $this->keyword_title . "」を含む投稿の検索が完了しました。";
            session()->flash('info', $message);
            return view('livewire.search-list')->with([
                'posts' => $posts,
                'reply' => $reply,
            ]);
        } else if (empty($this->keyword_name) && !empty($this->keyword_title) && !empty($this->keyword_body)) {
            $query = Post::query();
            $rquery = Reply::query();
            $posts = $query->where('title', 'like', '%' . $this->keyword_title . '%')->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts');
            $reply = $rquery->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply');
            $message = "「" . $this->keyword_title . "」と、「" . $this->keyword_body . "」を含む投稿の検索が完了しました。";
            session()->flash('info', $message);
            return view('livewire.search-list')->with([
                'posts' => $posts,
                'reply' => $reply,
            ]);
        } else if (!empty($this->keyword_name) && empty($this->keyword_title) && !empty($this->keyword_body)) {
            $query = Post::query();
            $rquery = Reply::query();
            $posts = $query->where('username', 'like', '%' . $this->keyword_name . '%')->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts');
            $reply = $rquery->where('username', 'like', '%' . $this->keyword_name . '%')->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply');
            $message = "「" . $this->keyword_name . "」と、「" . $this->keyword_body . "」を含む投稿の検索が完了しました。";
            session()->flash('info', $message);
            return view('livewire.search-list')->with([
                'posts' => $posts,
                'reply' => $reply,
            ]);
        } else if (!empty($this->keyword_name) && !empty($this->keyword_title) && !empty($this->keyword_body)) {
            $query = Post::query();
            $rquery = Reply::query();
            $posts = $query->where('username', 'like', '%' . $this->keyword_name . '%')->where('title', 'like', '%' . $this->keyword_title . '%')->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPagePost, ["*"], 'posts');
            $reply = $rquery->where('username', 'like', '%' . $this->keyword_name . '%')->where('body', 'like', '%' . $this->keyword_body . '%')->orderBy('id', 'desc')->paginate($this->perPageReply, ["*"], 'reply');
            $message = "「" . $this->keyword_name . "」と、「" . $this->keyword_title . "」と、「" . $this->keyword_body . "」を含む投稿の検索が完了しました。";
            session()->flash('info', $message);
            return view('livewire.search-list')->with([
                'posts' => $posts,
                'reply' => $reply,
            ]);
        } else if (empty($this->keyword_name) && empty($this->keyword_title) && empty($this->keyword_name)) {
            $message = "何かを入力してください。";
            session()->flash('error', $message);
            return view('livewire.search-list');
        } else {
            $message = "検索結果はありません。";
            session()->flash('info', $message);
            return view('livewire.search-list');
        }
    }
}
