<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('通知') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button type="submit" class="btn" onclick="reloadbutton();">
                        <img class="hover:animate-spin" src="{{ asset('site/reload.png') }}" width="25" height="">
                    </button>
                    <div class="mt-4">
                        <article class="prose max-w-none">
                            <livewire:notice-list />
                        </article>
                    </div>
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