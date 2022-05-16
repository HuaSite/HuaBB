<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('検索') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button type="submit" class="btn" onclick="reloadbutton();">
                        <img class="hover:animate-spin" src="{{ asset('site/reload.png') }}" width="25" height="">
                    </button>
                    <br>

                    <article class="prose max-w-none">
                        @livewire('search-list', ['keyword_name' => $keyword_name, 'keyword_title' => $keyword_title, 'keyword_body' => $keyword_body])
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script language="javascript" type="text/javascript">
    function reloadbutton() {
        window.location.reload();
    }
</script>