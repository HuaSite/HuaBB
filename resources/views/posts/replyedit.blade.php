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