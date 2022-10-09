<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('site/HuaBB.svg') }}" width="200" height="">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <label for="name">名前</label>

                <input id="name" class="block mt-1 w-full input input-bordered" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- User ID -->
            <div class="mt-4">
                <label for="user_id">ユーザーID</label>

                <input id="user_id" class="block mt-1 w-full input input-bordered" type="text" name="user_id" :value="old('user_id')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password">パスワード</label>

                <input id="password" class="block mt-1 w-full input input-bordered" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation">パスワード(もう一度)</label>

                <input id="password_confirmation" class="block mt-1 w-full input input-bordered" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <label for="avatar">プロフィール画像(正方形で)</label>
                <input id="avatar" class="block mt-1 w-full @error('avatar') is-invalid @enderror input" type="file" name="avatar"/>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    登録してある？
                </a>

                <button class="ml-4 btn">
                    登録！
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
