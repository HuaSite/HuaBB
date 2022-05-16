<x-app-layout>
    <div x-data="{replyshow: false}">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('投稿') }}
            </h2>
        </x-slot>
        <div class="sticky top-0">
            <div class="sticky mockup-window border bg-base-300 animate__animated animate__slideInDown"
                x-show="replyshow">
                <button class="absolute w-3 h-3 top-5 rounded-full bg-red-600 hover:bg-red-800" style="left: 1.40625rem"
                    @click="replyshow = false">
                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" class="m-auto w-1.5 h-1.5"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                        xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: rgb(255, 255, 255);
                            }
                        </style>
                        <g>
                            <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465 
                            52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"
                                style="fill: rgb(255, 255, 255);"></polygon>
                        </g>
                    </svg>
                </button>
                <div class="overflow-y-auto max-h-96">
                    <div class="flex justify-center px-4 py-16 bg-base-200">
                        <div class="bg-stone-50 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-stone-50 border-b border-gray-200">
                                <div class="col-10 col-md-6 offset-1 offset-md-3">
                                    <article class="prose max-w-none">
                                        <form action="{{ route('replystore') }}" method="post" name="ansform"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <p>
                                            <h3>返信するID</h3>
                                            <input type="text" class="input input-bordered block mt-1 w-full max-w-xs"
                                                name="post_id" value="{{ $post->id }}" readonly />
                                            <input type="text" class="input input-bordered block mt-1 w-full max-w-xs"
                                                name="reply_user_id" value="{{ $post->user_idname }}" readonly />
                                            </p>
                                            <h3>本文</h3>
                                            <textarea id="huabbbody" name="body"></textarea>
                                            <div tabindex="0"
                                                class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                                                <input type="checkbox">
                                                <div class="collapse-title text-xl font-medium text-center">
                                                    <h2>ペイント</h2>
                                                </div>
                                                <h4 class="text-center">ダウンロードしてpngにして貼り付けて使ってください</h4>
                                                <div class="collapse-content">
                                                    <div class="overflow-x-auto" style="height: 29rem;">
                                                        <div id="paint"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3>ファイル</h3>
                                            <div class="non-prose">
                                                <input type="file" class="input" name="file" id="file">
                                                <input type="button" class="btn" value="ファイルをクリア" onclick="test();">
                                                <script>
                                                    function test(){
                                                    var obj = document.getElementById("file");
                                                    obj.value = "";
                                                }
                                                </script>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn">返信する
                                                </button>
                                            </div>
                                        </form>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        @foreach ($reply as $rep)
                        @if (!empty($rep->id))
                        <div class="pt-2">
                            <div class="max-w-6xl mx-auto sm:px-4 lg:px-6">
                                <div class="bg-stone-50 hover:bg-stone-100 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-stone-50 hover:bg-stone-100 border-b border-gray-200">
                                        <div class="flex flex-wrap">
                                            <div class="mr-1">
                                                <a href="{{ route('profile', ['id' => $rep->user_idname]) }}"><img
                                                        src="{{ asset('file/profile/'.$rep->user_id.'/'.$rep->user_avatar) }}"
                                                        class="rounded-full" width="50" height="50"></a>
                                            </div>
                                            <div class="text-center mr-1 py-4">
                                                {{ $rep->username }}</div>
                                            <div class="text-center mr-4 py-4">
                                                <a href="{{ route('profile', ['id' => $rep->user_idname]) }}"
                                                    class="link link-hover text-blue-400">{{
                                                    __('@') }}{{
                                                    $rep->user_idname }}</a>
                                            </div>
                                            <div class="text-center text-xs text-gray-400 mr-2 sm:py-5 py-1">
                                                {{ $rep->created_at }}
                                            </div>
                                            <hr>
                                            <div class="text-center text-xs text-gray-400 sm:py-5 py-1">
                                                ({{ $rep->updated_at }})
                                            </div>
                                        </div>
                                        <div>
                                            <div class="my-4">
                                                <article class="prose max-w-none">
                                                    <p class="break-words">{!! $rep->body !!}</p>
                                                </article>
                                            </div>
                                            <a href="{{ asset('file/'.$rep->user_id.'/'.$rep->file) }}"
                                                class="link link-hover link-primary">
                                                <p class="font-bold">{{ $rep->file }}</p>
                                            </a>
                                            <div class="mt-4">
                                                @auth
                                                @if (Auth::id() == $rep->user_id)
                                                <span class="inline-block">
                                                    <a href="{{ route('replyedit', ['id' => $rep->id]) }}">
                                                        <input type="image" class="animate__animated editani"
                                                            src="{{ asset('site/edit.png') }}" width="30">
                                                    </a>
                                                </span>
                                                <span class="inline-block">
                                                    <form action="{{ route('replydestroy', ['id' => $rep->id]) }}"
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
                        @endif
                        @endforeach
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