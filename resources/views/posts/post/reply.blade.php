<div class="flex justify-start w-full items-center overflow-x-auto">
    <div class="mr-2">
        <a href="{{ route('profile', ['id' => $rep->user_idname]) }}"><img
                src="{{ asset('file/profile/' . $rep->user_id . '/' . $rep->user_avatar) }}" class="rounded-full" width="50" height="50"></a>
    </div>
    <div>
        <ul class="pb-1.5 mr-2">
            <li>
                <a href="{{ route('rep', ['id' => $rep->id]) }}" class="link link-hover">
                    <p class="py-0 mt-0">PostID: {{ $rep->post_id }} に対しての返信</p>
                </a>
            </li>
            <li>
                <a href="{{ route('profile', ['id' => $rep->user_idname]) }}" class="link link-hover link-primary">
                    <p class="text-xs py-0 mt-0">{{ $rep->username }}</p>
                </a>
            </li>
        </ul>
    </div>
    <div id="Postright">
        @auth
        @if (Auth::id() == $rep->user_id)
        <form action="{{ route('replydestroy', ['id' => $rep->id]) }}" method="POST"
            onsubmit="return deleteStore(this);">
            @csrf
            <input type="image" class="animate__animated deleteani" src="{{ asset('site/delete.png') }}" width="30">
        </form>
        @endif
        @endauth
    </div>
</div>