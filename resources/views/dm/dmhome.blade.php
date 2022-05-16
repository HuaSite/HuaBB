<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('DMを送るユーザーを選択する') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <article class="prose max-w-none">
                        <h3>DMを送るユーザーを検索</h3>
                        <p class="text-gray-600 text-xs">「*」ですべてのユーザを表示します</p>
                    </article>
                    <form action="{{ route('dmsearch') }}" method="POST">
                        @csrf
                        {{ method_field('get') }}
                        <div class="form-group">
                            <label>名前</label>
                            <input type="text" class="input input-bordered block mt-1 w-full max-w-xs" placeholder="検索したい名前を入力" name="name" />
                        </div>
                        <div class="form-group">
                            <label>ユーザーID</label>
                            <input type="text" class="input input-bordered block mt-1 w-full max-w-xs" placeholder="ユーザーIDを入力" name="idname" />
                        </div>
                        <br>
                        <button type="submit" class="btn">検索</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>