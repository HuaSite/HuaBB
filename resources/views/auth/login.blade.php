<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('site/HuaBB.svg') }}" width="200" height="">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="user_id">ユーザーID</label>

                <input id="user_id" class="block mt-1 w-full input input-bordered" type="text" name="user_id"
                    :value="old('user_id')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password">パスワード</label>

                <input id="password" class="block mt-1 w-full input input-bordered" type="password" name="password"
                    required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">ログインしたままにする</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    まだ登録していませんか？
                </a>

                <button class="ml-3 btn">
                    ログイン
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>