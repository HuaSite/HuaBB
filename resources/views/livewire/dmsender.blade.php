<div class="w-full bg-white overflow-hidden shadow-sm">
    <div class="p-6 bg-white border-b border-gray-200">
        <form wire:submit.prevent="send">
            @csrf
            <input type="text" wire:model="peeruser_id" readonly hidden />
            <div class="mb-0.5">
                <textarea type="text" wire:model="dm_body" style="width: 100%;" placeholder="本文を入力"
                    class="input input-bordered" required></textarea>
            </div>
            <div>
                <input type="file" wire:model="dm_file" placeholder="ファイル" class="input" />
            </div>
            <button class="btn">投稿</button>
        </form>
    </div>
</div>