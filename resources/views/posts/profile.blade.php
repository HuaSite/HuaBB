<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ $user->name }}
            <b>@</b>{{ $user->user_id }}
            {{ __('さんのページ') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <article class="prose max-w-none">
                        <div class="not-prose flex items-center">
                            <a href="{{ route('profile', ['id' => $user->user_id]) }}"><img
                                    src="{{ asset('file/profile/'.$user->id.'/'.$user->avatar) }}"
                                    class="rounded-full mr-1" width="50" height="50"></a>
                            <h3 class="mr-1">{{ $user->name }}</h3>
                            <a href="{{ route('profile', ['id' => $user->user_id]) }}" class="link link-hover mr-1">{{
                                __('@') }}{{
                                $user->user_id }}</a>
                        </div>
                        <hr class="mx-4 my-2">
                        @if ($user->profile != null)
                        {!! $user->profile !!}
                        <hr class="mx-4 my-2">
                        @endif
                        <div>
                            @livewire('profile-list', ['user_id' => $user_id])
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>