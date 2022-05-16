<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('アカウント削除') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ password: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-3xl text-red-600 text-center">警告</p>
                    <p class="text-center">ここはアカウントを削除するページです。</p>
                    <p class="text-center">アカウントを削除すると次のデータが削除されます。</p>
                    <li class="text-center">
                         すべてのデータ
                    </li>
                    <p class="text-red-600 text-center">アカウントを削除すると二度と戻せなくなりますがよろしいでしょうか？</p>
                    <div class="flex justify-evenly">
                        <a href="{{ route('index') }}">
                            <button class="btn btn-primary">戻る</button>
                        </a>
                        <button class="btn btn-secondary" @click="password = true">削除する</button>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="password" tabindex="0" class="m-auto z-50 overflow-auto inset-0 max-w-md h-full fixed py-6">
            <div @click.away="password = false" class="z-50 relative p-3 mx-auto my-0 max-w-full" x-show="password"
                x-transition:enter="transition duration-500"
                x-transition:enter-start="transform opacity-0 -translate-y-4"
                x-transition:enter-end="transform opacity-100 translate-y-0"
                x-transition:leave="transition -translate-y-4"
                x-transition:leave-start="transform opacity-100 translate-y-0"
                x-transition:leave-end="transform opacity-0 -translate-y-4">
                <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
                    <div class="bg-slate-100">
                        <div class="mt-1 mb-2 ml-2">
                            <button class="w-3 h-3 rounded-full bg-red-600 hover:bg-red-800" @click="pp = false">
                                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                    class="m-auto w-1.5 h-1.5" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                    y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                    <style type="text/css">
                                        .st0 {
                                            fill: rgb(255, 255, 255);
                                        }
                                    </style>
                                    <g>
                                        <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465 
                                52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"
                                            style="fill: rgb(255, 255, 255);"></polygon>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white  rounded shadow-lg border flex flex-col overflow-hidden">
                    <div class="px-6 py-3 text-xl border-b font-bold text-gray-800">
                        アカウントを削除します。</div>
                    <div class="p-6 flex-grow">
                        <p class="text-gray-500">アカウントを削除するにはパスワードを入力してください</p>
                    </div>
                    <form action="{{ route('AccountDelete') }}" method="POST" class="px-6 py-3 border-t">
                        @csrf
                        <input type="password" name="password" class="input input-bordered w-full mb-2" required />
                        <button class="btn bg-red-600 hover:bg-red-900">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>