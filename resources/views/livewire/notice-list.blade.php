<div>
    <h3>投稿</h3>
    <div class="not-prose">
        <div class="overflow-y-auto max-h-48">
            @forelse ($posts as $post)
            @include('posts.post.post')
            @empty
            <p class="text-slate-500">
                まだ何も無いようです…
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
    </div>
    <hr>
    <h3>リプライ</h3>
    <div class="not-prose">
        <div class="overflow-y-auto max-h-48">
            @forelse ($reply as $rep)
            @include('posts.post.reply')
            @empty
            <p class="text-slate-500">
                まだ何も無いようです…
            </p>
            @endforelse
            @if($reply->hasMorePages())
            <div x-data="{ loadreply: false }">
                <button @click="loadreply = true" x-show="loadreply = false" class="btn btn-sm" wire:click="loadMoreReply">ロードする</button>
                <button x-show="loadreply" class="btn btn-sm loading">
                    ロード中…
                </button>
            </div>
            @endif
        </div>
    </div>
</div>