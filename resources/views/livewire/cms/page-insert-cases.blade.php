<div class="py-12 mx-auto max-w-5xl flex flex-col gap-4">

    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('cms.coal-ruption.cases.index', ['locale' => app()->getLocale()]) }}"
            class="hover:underline text-gray-700 font-medium">
            Cases
        </a>

        <span class="text-gray-500">→</span>

        <span class="px-2 py-1 bg-black text-white font-medium">
            Input Cases
        </span>
    </div>

    @if(session('success'))
        <div class="p-3 border bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">

        <div>
            <label class="block text-sm font-medium mb-1">Title (ID)</label>
            <input type="text" wire:model="title_id" class="w-full border p-2 focus:outline-none"
                placeholder="Masukkan title Indonesia">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi (ID)</label>
            <x-tinymce id="deskripsi_id_editor" model="deskripsi_id" />
        </div>

        <hr class="border-gray-300">

        <div>
            <label class="block text-sm font-medium mb-1">Title (EN)</label>
            <input type="text" wire:model="title_en" class="w-full border p-2 focus:outline-none"
                placeholder="Masukkan title English">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi (EN)</label>
            <x-tinymce id="deskripsi_en_editor" model="deskripsi_en" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal</label>
                <input type="date" wire:model="tanggal" class="w-full border p-2 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select wire:model="status" class="w-full border p-2 focus:outline-none">
                    <option value="Y">Aktif</option>
                    <option value="N">Nonaktif</option>
                </select>
            </div>
        </div>


        {{-- <div>
            <label class="block text-sm font-medium mb-1">Upload Image</label>

            <input type="file" wire:model="image" class="w-full border p-2 focus:outline-none">

            @if($image)
            <div class="mt-3 border p-2 w-full">
                <img src="{{ $image->temporaryUrl() }}" class="w-full max-h-64 object-contain">
            </div>
            @endif
        </div> --}}

        <div class="flex justify-end gap-2 pt-2">
            <button type="button" wire:click="save" class="px-4 py-2 border hover:bg-gray-100 font-medium">
                Simpan
            </button>
        </div>

    </div>

</div>