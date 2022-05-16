<div>
    @forelse ($posts as $post)
    @include('posts.post.post')
    @empty
    <p class="text-slate-500">
        まだ何も無いようです…
    </p>
    @endforelse
    @if($posts->hasMorePages())
    <div x-data="{ load: false }">
        <button @click="load = true" x-show="!load" class="btn btn-sm" wire:click="loadMore">ロードする</button>
        <button x-show="load" class="btn btn-sm loading">
            ロード中…
        </button>
    </div>
    @endif
</div>