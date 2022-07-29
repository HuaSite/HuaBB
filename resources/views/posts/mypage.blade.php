<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マイページ') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <article class="prose max-w-none">
                        <h2>{{ $user->name }}</h2>
                        <p class="text-sky-400 font-bold">現在のプロフィール画像</p>
                        <a href="{{ route('profile', ['id' => $user->user_id]) }}">
                            <img src="{{ asset('file/profile/'.$user->id.'/'.$user->avatar) }}" class="rounded-full"
                                width="50" height="50">
                        </a>
                        <hr class="mx-4 my-2">
                        <p class="text-green-400 font-bold">プロフィール画像変更</p>
                        <form action="{{ route('myprofile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-wrap items-center">
                                <span>
                                    <label for="avatar">プロフィール画像(正方形)</label>
                                </span>
                                <span>
                                    <input id="avatar" type="file" name="avatar"
                                        class="@error('avatar') は壊れているか別のファイルです。 @enderror input"
                                        onchange="previewImage(this);" required>
                                </span>
                                @error('avatar')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span>
                                    <button type="submit" class="btn">変更</button>
                                </span>
                                <span>
                                    <img id="preview" class="rounded-full"
                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                        width="50" height="50">
                                </span>
                            </div>
                        </form>
                        <div class="not-prose">
                            <a href="{{ route('deleteaccount') }}" class="link link-hover link-primary">アカウント削除申請</a>
                        </div>
                        <form action="{{ route('profiletextupdate') }}" method="POST" enctype="multipart/form-data">
                            <div class="flex justify-center min-w-full">
                                <div tabindex="0"
                                    class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                                    <input type="checkbox">
                                    <div class="collapse-title text-xl font-medium text-center">
                                        <span class="text-green-300 font-bold ">自己紹介文</span>
                                    </div>
                                    <div class="collapse-content">
                                        @csrf
                                        <textarea id="huabbbody" name="profile">{{ $user->profile }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <button type="submit" class="btn">変更</button>
                            </div>
                        </form>
                        <p class="text-cyan-300 font-bold">あなたの投稿</p>
                        <livewire:mypage-list />
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function previewImage(obj) {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            document.getElementById('preview').src = fileReader.result;
        });
        fileReader.readAsDataURL(obj.files[0]);
    }
</script>