<x-app-layout>
    <div x-data="{replyshow: false}">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('投稿') }}
            </h2>
        </x-slot>
        @include('posts.reply')
        <div class="pt-12 pb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <button type="submit" class="btn" onclick="reloadbutton();">
                            <img class="hover:animate-spin" src="{{ asset('site/reload.png') }}" width="25" height="">
                        </button>
                        <div class="pt-6 pb-2">
                            <div class="max-w-6xl mx-auto sm:px-4 lg:px-6">
                                <div class="bg-slate-50 hover:bg-slate-100 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-slate-50 hover:bg-slate-100 border-b border-gray-200">
                                        <div class="flex flex-wrap">
                                            <div class="mr-1">
                                                <a href="{{ route('profile', ['id' => $post->user_idname]) }}"><img
                                                        src="{{ asset('file/profile/'.$post->user_id.'/'.$post->user_avatar) }}"
                                                        class="rounded-full" width="50" height="50"></a>
                                            </div>
                                            <div class="text-center mr-1 py-4">
                                                {{ $post->username }}
                                            </div>
                                            <div class="text-center mr-4 py-4">
                                                <a href="{{ route('profile', ['id' => $post->user_idname]) }}"
                                                    class="link link-hover text-blue-400">{{ __('@') }}{{
                                                    $post->user_idname }}</a>
                                            </div>
                                            <div class="text-center text-xs text-gray-400 mr-2 sm:py-5 py-1">
                                                {{ $post->created_at }}
                                            </div>

                                            <div class="text-center text-xs text-gray-400 sm:py-5 py-1">({{
                                                $post->updated_at }})</div>
                                        </div>
                                        <div>
                                            @if ($post->title != null)
                                            <div class="break-words text-2xl font-bold">
                                                {{ $post->title }}
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="my-4">
                                                <article class="prose max-w-none break-words">
                                                    <p>{!! $post->body !!}</p>
                                                </article>
                                            </div>
                                            <a href="{{ asset('file/'.$post->user_id.'/'.$post->file) }}"
                                                class="link link-hover link-primary">
                                                <p class="font-bold">{{ $post->file }}</p>
                                            </a>
                                            @guest
                                            返信するには<a href="{{ route('login') }}" class="link link-hover link-primary">
                                                <span class="font-bold">ログイン</span>
                                            </a>または<a href="{{ route('register') }}"
                                                class="link link-hover link-secondary">
                                                <span class="font-bold">登録</span>
                                            </a>してください。
                                            メールアドレスはいりません。
                                            @endguest
                                            <div class="mt-4">
                                                <p class="text-sm">
                                                    {{ $likepost->count() }} いいね
                                                </p>
                                                @auth
                                                @if(is_null($likepost->where('user_id', Auth::id())->first()))
                                                <span class="inline-block">
                                                    <form action="{{ route('postlike', ['id' => $post->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="number" value="{{ $post->id }}" name="post_id"
                                                            readonly hidden />
                                                        <input type="image" src="{{ asset('site/nolike.svg') }}"
                                                            width="30">
                                                    </form>
                                                </span>
                                                @elseif(!is_null($likepost->where('user_id', Auth::id())->first()))
                                                <span class="inline-block">
                                                    <form action="{{ route('postunlike', ['id' => $post->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="number" value="{{ $post->id }}" name="post_id"
                                                            readonly hidden />
                                                        <input type="image" src="{{ asset('site/like.svg') }}"
                                                            width="30">
                                                    </form>
                                                </span>
                                                @endif
                                                <span class="inline-block">
                                                    <input type="image" class="animate_animated replyani"
                                                        src="{{ asset('site/reply.png') }}"
                                                        @click="replyshow = !replyshow" width="30">
                                                </span>
                                                @if (Auth::id() == $post->user_id)
                                                <span class="inline-block">
                                                    <a href="{{ route('edit', ['id' => $post->id]) }}">
                                                        <input type="image" class="animate__animated editani"
                                                            src="{{ asset('site/edit.png') }}" width="30" />
                                                    </a>
                                                </span>
                                                <span class="inline-block">
                                                    <form action="{{ route('destroy', ['id' => $post->id]) }}"
                                                        method="POST" onsubmit="return deleteStore(this);">
                                                        @csrf
                                                        <input type="image" class="animate__animated deleteani"
                                                            src="{{ asset('site/delete.png') }}" width="30">
                                                    </form>
                                                </span>
                                                @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('posts.replies')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script language="javascript" type="text/javascript">
    function reloadbutton() {
        window.location.reload();
    }
</script>