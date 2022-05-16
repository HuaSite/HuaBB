<style>
    #Post {
        display: inline-block;
        vertical-align: middle;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('検索結果') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>{{ $message }}</h3>
                    <br>
                    @if (isset($users))
                    @foreach ($users as $user)
                    @if (Auth::id() != $user->id)
                    <table class="table-auto w-full">
                        <div id="Post">
                            <a href="{{ route('profile', ['id' => $user->user_id]) }}" id="Post"><img
                                    src="{{ asset('file/profile/'.$user->id.'/'.$user->avatar) }}" class="rounded-full" width="50"
                                    height="50"></a>
                        </div>
                        <span id="Post" style="word-break: break-word;">
                            <a href="{{ route('profile', ['id' => $user->user_id]) }}">&nbsp;{{ $user->name
                                }}</a>
                        </span>
                        @if (Auth::id() > $user->id)
                        <a href="{{ route('dm', ['id' => Auth::user()->id, 'id2' => $user->id]) }}"
                            onclick="window.open('{{ route('dm', ['id' => Auth::user()->id, 'id2' => $user->id]) }}', '{{ $user->name }} さんとのDM','width=600,height=800,noopener'); return false;">
                            @csrf
                            <button type="submit" class="btn" id="Post"
                                style="background:rgb(0, 160, 255);color:rgb(255, 255, 255);"
                                class="btn btn-primary col-md-5">DMを送る</button>
                        </a>
                        @elseif($user->id > Auth::id())
                        <a href="{{ route('dm', ['id' => $user->id, 'id2' => Auth::user()->id]) }}"
                            onclick="window.open('{{ route('dm', ['id' => $user->id, 'id2' => Auth::user()->id]) }}', '{{ $user->name }} さんとのDM','width=640,height=480,noopener'); return false;">
                            @csrf
                            &nbsp;
                            <button type="submit" class="btn" id="Post"
                                style="background:rgb(0, 160, 255);color:rgb(255, 255, 255);"
                                class="btn btn-primary col-md-5">DMを送る</button>
                        </a>
                        @endif
                    </table>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>