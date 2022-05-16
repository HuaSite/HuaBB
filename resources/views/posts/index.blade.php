<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿一覧') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button type="submit" class="btn" onclick="reloadbutton();">
                        <img class="hover:animate-spin" src="{{ asset('site/reload.png') }}" width="25" height="">
                    </button>
                    <div class="my-4">
                        <article class="prose max-w-none">
                            <h3>
                                検索
                            </h3>
                        </article>
                        <form action="{{ route('serach') }}" method="post">
                            @csrf
                            {{ method_field('get') }}
                            <div class="form-group">
                                <p>名前</p>
                                <input type="text" placeholder="検索したい名前を入力"
                                    class="input input-bordered block mt-1 w-full max-w-xs" name="name" />
                            </div>
                            <div class="form-group">
                                <p>タイトル</p>
                                <input type="text" placeholder="タイトル名を入力"
                                    class="input input-bordered block mt-1 w-full max-w-xs" name="title" />
                            </div>
                            <div class="form-group">
                                <p>投稿</p>
                                <input type="text" placeholder="投稿にある文を入力"
                                    class="input input-bordered block mt-1 w-full max-w-xs" name="body" />
                            </div>
                            <p class="my-2"></p>
                            <button type="submit" class="btn"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg></button>
                        </form>
                    </div>
                    <div class="not-prose">
                        <div class="overflow-y-auto max-h-96">
                            <livewire:post-list />
                        </div>
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