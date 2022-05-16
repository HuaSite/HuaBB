<div>
    <h2>検索結果</h2>
    <hr>
    @isset($posts)
    <h3>投稿</h3>
    <hr>
    <div class="overflow-y-auto max-h-48">
        @forelse ($posts as $post)
        <article class="not-prose">
            @include('posts.post.post')
        </article>
        @empty
        <p class="text-slate-500">
            何もありません…
        </p>
        @endforelse
        @if($posts->hasMorePages())
        <div x-data="{ load: false }">
            <button @click="load = true" x-show="!load" class="btn btn-sm" wire:click="loadMorePost">ロードする</button>
            <button x-show="load" class="btn btn-sm loading">
                ロード中…
            </button>
        </div>
        @endif
    </div>
    @endisset
    @isset($reply)
    <h3>リプライ</h3>
    <hr>
    <div class="overflow-y-auto max-h-48">
        @forelse ($reply as $rep)
        <div class="not-prose">
            @include('posts.post.reply')
        </div>
        @empty
        <p class="text-slate-500">
            何もありません…
        </p>
        @endforelse
        @if($reply->hasMorePages())
        <div x-data="{ load: false }">
            <button @click="loadreply = true" x-show="!loadreply" class="btn btn-sm" wire:click="loadMoreReply">ロードする</button>
            <button x-show="loadreply" class="btn btn-sm loading">
                ロード中…
            </button>
        </div>
        @endif
    </div>
    @else
    <p class="text-slate-500">
        リプライは表示されません
    </p>
    @endisset
</div>