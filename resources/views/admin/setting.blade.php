<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('設定(※管理者のみ)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('settingupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <p class="font-bold">ユーザの権限設定</p>
                            <hr class="mx-4 my-2">
                            @forelse ($users as $user)
                            <div class="mb-2 flex items-center">
                                <a href="{{ route('profile', ['id' => $user->user_id]) }}"
                                    class="flex items-center mr-10">
                                    <span><img src="{{ asset('file/profile/' . $user->id . '/' . $user->avatar) }}"
                                            class="rounded-full" width="50" height="50"></span>
                                    <span class="link link-hover link-primary">{{ $user->name }}</span></a>
                                <span>
                                    <p class="font-bold">権限</p>
                                    @can('admin')
                                    <div>
                                        {{ Form::radio("$user->id", '0', (old('role') == '0' ? true :
                                        $user->role ==
                                        '0') ?
                                        true : false, ['class' => 'radio-button__input']) }}
                                        <label class="text-yellow-400">管理者(admin)</label>
                                    </div>
                                    @endcan
                                    @can('owner')
                                    <div>
                                        {{ Form::radio("$user->id", '1', (old('role') == '1' ? true :
                                        $user->role ==
                                        '1') ?
                                        true : false, ['class' => 'radio-button__input']) }}
                                        <label class="text-red-600">オーナー(owner)</label>
                                    </div>
                                    @endcan
                                    @can('user')
                                    <div>
                                        {{ Form::radio("$user->id", '2', (old('role') == '2' ? true :
                                        $user->role ==
                                        '2') ?
                                        true : false, ['class' => 'radio-button__input']) }}
                                        <label class="text-blue-300">ユーザー(user)</label>
                                    </div>
                                    @endcan
                                </span>
                            </div>
                            @empty
                            @endforelse
                            {{ $users->links() }}
                        </div>
                        <button type="submit" class="btn">更新</button>
                        <hr class="mx-4 my-2">
                    </form>
                    @can('owner')
                    <form action="{{ route('settingimageupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-0.5 flex items-center">
                            <span class="mb-0.5 mr-1">
                                <p class="text-blue-400 font-bold">トップ画像の大きさ(横)</p>
                                <input name="topsize" type="number" class="input input-bordered" />
                            </span>
                            <span class="mr-1">
                                <p class="text-cyan-400 font-bold mt-0.5">このフォーラムのトップ画像(できればsvgでお願いします)</p>
                                <input id="topimage" type="file" name="topimage" class="input"
                                    class="@error('topimage') は壊れているか別のファイルです。 @enderror" />
                                @error('topimage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </span>
                            <button class="btn">更新</button>
                        </div>
                        <hr class="mx-4 my-2">
                    </form>
                    @endcan
                    @can('owner')
                    <form action="{{ route('settingappnameupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p class="text-green-400 font-bold">サイトの名前</p>
                        <div class="mb-0.5 flex items-center">
                            <input name="setname" class="input input-bordered mr-1" type="text" />
                            <button class="btn">更新</button>
                        </div>
                        <hr class="mx-4 my-2">
                    </form>
                    @endcan
                    @can('admin')
                    <form action="{{ route('settingdebugupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p class="text-red-600 font-bold">デバッグ(基本的にfalse)</p>
                        <div class="mb-0.5 flex items-center">
                            <div class="mr-1">
                                <div>
                                    {{ Form::radio('setdebug', 'true', (old('setdebug') == 'false' ? true :
                                    config('app.debug') == '1') ? true : false, ['class' => 'radio-button__input']) }}
                                    <label>true</label>
                                </div>
                                <div>
                                    {{ Form::radio('setdebug', 'false', (old('setdebug') == 'false' ? true :
                                    config('app.debug') == '0') ? true : false, ['class' => 'radio-button__input']) }}
                                    <label>false</label>
                                </div>
                            </div>
                            <button class="btn">更新</button>
                        </div>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>