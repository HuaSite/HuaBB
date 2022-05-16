<div wire:poll="dmreload">
    @forelse ($dms as $dirmes)
    &nbsp;
    <div class="single-message @if ($myuser_id == $dirmes->dm_user_id) sent @else received @endif">
        <span class="inline-block align-middle">
            <a href="{{ route('profile', ['id' => $dirmes->dm_user_idname]) }}"><img
                    src="{{ asset('file/profile/'.$dirmes->dm_user_id.'/'.$dirmes->user_avatar) }}" class="rounded-full"
                    width="50" height="50"></a>
        </span>
        <span class="inline-block align-middle break-words">
            <ul>
                <li>
                    <p class="my-0 py-0">
                    <p class="whitespace-pre-wrap text-lg">{{ $dirmes->body }}</p>
                    </p>
                </li>
                <li>
                    <p class="my-0 py-0"><a href="{{ route('profile', ['id' => $dirmes->dm_user_idname]) }}">
                            <p class="text-xs">{{ $dirmes->dm_username }}
                            </p>
                        </a>
                    </p>
                </li>
                <li>
                    <p class="my-0 py-0">
                    <p class="text-xs">
                        {{ $dirmes->created_at }}
                    </p>
                    </p>
                </li>
                <li>
                    <p class="my-0 py-0">
                        <a href="{{ asset('file/dm/'.$dirmes->room_id.'/'.$dirmes->file) }}"
                            class="link link-hover link-primary text-xs">
                            {{ $dirmes->file }}
                        </a>
                    </p>
                </li>
            </ul>
        </span>
        @if ($myuser_id == $dirmes->dm_user_id)
        <span class="inline-block align-middle">
            <form wire:submit.prevent="opendeletedialog({{ $dirmes->id }})">
                @csrf
                <input type="image" src="{{ asset('site/delete.png') }}" width="30">
            </form>
        </span>
        @endif
    </div>
    @empty
    <p class="text-slate-500 text-center">まだ何も無いようです…</p>
    @endforelse
    @if ($deleteopen)
    <div class="animate__animated animate__slideInDown overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
        id="modal-example-regular">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <div class=" flex items-start justify-between p-5 border-b border-solid border-gray-200 rounded-t">
                    <h3 class="text-3xl font-semibold">削除しますか？</h3>
                </div>
                <div class="relative p-6 flex-auto">
                    <p class="my-4 text-gray-500 text-lg leading-relaxed">
                        削除したら二度と復元できません！
                    </p>
                </div>
                <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b">
                    <button class="btn mr-0.5" wire:click="closedeletedialog()" type="button"
                        onclick="toggleModal('modal-example-regular')">
                        キャンセル
                    </button>
                    <button class="btn bg-red-600 hover:bg-red-700" wire:click.prevent="dmdestroy()" type="button"
                        onclick="toggleModal('modal-example-regular')">
                        削除する
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>