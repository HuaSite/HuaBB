<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('返信の編集') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <article class="prose max-w-none">
                        <form action="{{ route('replyupdate') }}" method="post" name="ansform"
                            enctype="multipart/form-data">
                            @csrf
                            <h3>本文</h3>
                            <textarea id="huabbbody" name="body">{{ $rep->body}}</textarea>
                            <div class="text-center mt-3">
                                <input name="rep_id" type="hidden" value="{{ $rep->id }}">
                                <button type="submit" class="btn">変更する</button>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>