<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('リプライ') }}
        </h2>
    </x-slot>
    <div class="pt-12 pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
