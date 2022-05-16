<div x-data="{ open: false }" class="mr-2 -mb-1.5">
    <button id="navbartoggle" type="button" class="text-gray-800 hover:text-gray-700 focus:outline-none focus:ring-0"
        aria-controls="mobile-menus" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
        <span class="sr-only">Mobile menu</span>
        <svg x-description="Icon closed" x-state:on="Menu open" x-state:off="Menu closed" class="block h-12 w-12"
            :class="{ 'hidden': open, 'block': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>

        <svg x-description="Icon open" x-state:on="Menu open" x-state:off="Menu closed" class="hidden h-12 w-12"
            :class="{ 'block': open, 'hidden': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <div class="fixed w-full h-full inset-0 z-50" id="mobile-menus" x-description="Mobile menu" x-show="open"
        style="display: none;">

        <span class="fixed bg-gray-900 bg-opacity-70 w-full h-full inset-x-0 top-0"></span>

        <nav id="mobile-nav"
            class="flex flex-col sm:left-0 right-0 w-64 fixed top-0 py-2 bg-white dark:bg-gray-800 h-full overflow-auto z-40"
            x-show="open" @click.away="open=false" x-description="Mobile menu" role="menu" aria-orientation="vertical"
            aria-labelledby="navbartoggle" x-transition:enter="transform transition-transform duration-300"
            x-transition:enter-start="sm:-translate-x-full translate-x-full"
            x-transition:enter-end="sm:-translate-x-0 translate-x-0"
            x-transition:leave="transform transition-transform duration-300"
            x-transition:leave-start="sm:-translate-x-0 translate-x-0"
            x-transition:leave-end="sm:-translate-x-full translate-x-full">
            <div class="mb-auto">
                <div class="flex items-center justify-start mx-6 mt-4 px-6">
                    <a href="{{ route('index') }}">
                        <img class="pointer-events-none" width="{{ config('topimagesize.size') }}" height=""
                            src="{{ asset('site/HuaBB.svg') }}" />
                    </a>
                </div>
                <div class="mb-4">
                    <nav class="px-6 pb-2">
                        @auth
                        <div>
                            <p
                                class="text-gray-400 ml-2 w-full border-b-2 pb-2 border-gray-100 mb-2 mt-2 text-md font-normal">
                                ユーザ
                            </p>
                            <p class="ml-4 mb-2">
                                <a href="{{ route('profile', ['id' => Auth::user()->user_id]) }}"><img
                                        src="{{ asset('file/profile/' . Auth::id() . '/' . Auth::user()->avatar) }}"
                                        class="rounded-full" width="50" height="50" class="rounded-full"></a>
                            </p>
                            <p class="text-gray-600 ml-4 w-full pb-1 mb-2">
                                <span class="text-md font-bold">{{ Auth::user()->name }}</span>
                                <span class="text-sm">{{ __('@') }}{{ Auth::user()->user_id }}</span>
                            </p>
                        </div>
                        <div>
                            <p
                                class="text-gray-400 ml-2 w-full border-b-2 pb-2 border-gray-100 mb-4 mt-2 text-md font-normal">
                                フォーラム
                            </p>
                            <x-responsive-nav-link :href="route('mypage')" :active="request()->routeIs('mypage')">
                                {{ __('マイページ') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('create')" :active="request()->routeIs('create')">
                                {{ __('新規投稿') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('notice')" :active="request()->routeIs('notice')">
                                @if(DB::table('posts')->where('notification', 1)->where('user_id','<>
                                    ',Auth::id())->where(function ($query)
                                    {
                                    return $query->orWhere('title', 'like', '%' . Auth::user()->user_id .
                                    '%')->orWhere('body', 'like', '%' . Auth::user()->user_id .
                                    '%')->orWhere('everyone', 1);
                                    })->count() ||
                                    DB::table('reply')->where('reply_user_idname',
                                    Auth::user()->user_id)->where('notification', 1)->where('user_id','<>
                                        ',Auth::id())->orWhere('body', 'like', '%' . Auth::user()->user_id .
                                        '%')->count())
                                        <div class="relative">
                                            {{ __('通知') }}
                                            <div
                                                class="absolute top-0 right-0 -mr-2 -mt-2 w-4 h-4 rounded-full bg-blue-300 animate-ping">
                                            </div>
                                            <div
                                                class="absolute top-0 right-0 -mr-2 -mt-2 w-4 h-4 rounded-full bg-blue-300">
                                            </div>
                                        </div>
                                        @else
                                        {{ __('通知') }}
                                        @endif
                            </x-responsive-nav-link>
                        </div>
                        <div>
                            <p
                                class="text-gray-400 ml-2 w-full border-b-2 pb-2 border-gray-100 mb-4 mt-2 text-md font-normal">
                                メッセージ
                            </p>
                            <x-responsive-nav-link :href="route('dmhome')" :active="request()->routeIs('dmhome')">
                                {{ __('DM') }}
                            </x-responsive-nav-link>
                        </div>
                        @can('owner')
                        <div>
                            <p
                                class="text-gray-400 ml-2 w-full border-b-2 pb-2 border-gray-100 mb-4 mt-2 text-md font-normal">
                                管理者
                            </p>
                            <x-responsive-nav-link :href="route('setting')" :active="request()->routeIs('setting')">
                                {{ __('このフォーラムの設定') }}
                            </x-responsive-nav-link>
                        </div>
                        @endcan
                        @endauth
                        <div>
                            <p
                                class="text-gray-400 ml-2 w-full border-b-2 pb-2 border-gray-100 mb-4 mt-2 text-md font-normal">
                                アカウント
                            </p>
                            @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('ログアウト') }}
                                </x-responsive-nav-link>
                            </form>
                            @endauth
                            @guest
                            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                {{ __('ログイン') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                {{ __('登録') }}
                            </x-responsive-nav-link>
                            @endguest
                        </div>
                        @auth
                        <div>
                            <p
                                class="text-gray-400 ml-2 w-full border-b-2 pb-2 border-gray-100 mb-4 mt-2 text-md font-normal">
                                プッシュ通知
                            </p>
                            <button id="enable-push" class="btn btn-sm mb-2">通知オン</button>
                            <button id="disable-push" class="btn btn-sm">通知オフ</button>
                        </div>
                        @endauth
                    </nav>
                </div>
            </div>
        </nav>
    </div>
</div>