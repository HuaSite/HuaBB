<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿の編集') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('update') }}" method="post" name="ansform" enctype="multipart/form-data">
                        @csrf
                        <article class="prose max-w-none">
                            <h2>タイトル</h2>
                            <input type="text" required class="input input-bordered block mt-1 w-full max-w-xs"
                                name="title" rows="1" placeholder="タイトル" value="{{ $post->title }}" />
                            <h3>本文</h3>
                            <textarea id="huabbbody" name="body">{{ $post->body }}</textarea>
                            <div class="text-center mt-3">
                                <input name="post_id" type="hidden" value="{{ $post->id }}">
                                <x-button type="submit" class="btn btn-primary col-md-5">変更する</x-button>
                            </div>
                        </article>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>