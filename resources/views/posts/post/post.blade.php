<div class="flex justify-start w-full items-center overflow-x-auto">
    <div class="mr-2">
        <a href="{{ route('profile', ['id' => $post->user_idname]) }}"><img
                src="{{ asset('file/profile/' . $post->user_id . '/' . $post->user_avatar) }}" class="rounded-full" width="50"
                height="50" class="rounded-full"></a>
    </div>
    <div>
        <ul class="pb-1.5 mr-2">
            <li>
                @if ($post->title == null)
                <a href="{{ route('show', ['id' => $post->id]) }}" class="link link-hover link-secondary">
                    <p class="py-0 mt-0">null</p>
                </a>
                </p>
                @else
                <a href="{{ route('show', ['id' => $post->id]) }}" class="link link-hover">
                    <p class="py-0 mt-0">{!! nl2br(e(Str::limit($post->title, 70))) !!}</p>
                </a>
                @endif
                </a>
            </li>
            <li>
                <a href="{{ route('profile', ['id' => $post->user_idname]) }}" class="link link-hover link-primary">
                    <p class="text-xs py-0 mt-0">{{ $post->username }}</p>
                </a>
            </li>
        </ul>
    </div>
    <div>
        @auth
        @if (Auth::id() == $post->user_id)
        <form action="{{ route('destroy', ['id' => $post->id]) }}" method="POST" onsubmit="return deleteStore(this);">
            @csrf
            <input type="image" class="animate__animated deleteani" src="{{ asset('site/delete.png') }}" width="30">
        </form>
        @endif
        @endauth
    </div>
</div>