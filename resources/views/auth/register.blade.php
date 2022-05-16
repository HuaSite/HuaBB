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
                <x-label for="name" :value="__('名前')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- User ID -->
            <div class="mt-4">
                <x-label for="user_id" :value="__('ユーザーID')" />

                <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('パスワード')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('パスワード(もう一度)')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="avatar" :value="__('プロフィール画像(正方形で)')"/>
                <x-input id="avatar" class="block mt-1 w-full @error('avatar') is-invalid @enderror" type="file" name="avatar"/>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('登録してある？') }}
                </a>

                <x-button class="ml-4">
                    {{ __('登録！') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
