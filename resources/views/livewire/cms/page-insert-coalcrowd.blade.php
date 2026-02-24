<div class="py-12 space-y-6 max-w-5xl mx-auto">

    <div class="flex items-center gap-2 mb-6 text-xl">

        <a href="{{ route('cms.background.coalcrowd.index', ['locale' => app()->getLocale()]) }}" class="font-medium hover:underline">
            Coalcrowd
        </a>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>

        <span class="font-semibold">
            Insert Coalcrowd
        </span>

    </div>

    <form wire:submit.prevent="save" class="space-y-6">

        <div>
            <label class="block text-sm font-medium mb-1">
                Judul (Indonesia)
            </label>
            <input type="text" wire:model.defer="title_id" class="w-full px-3 py-2 border focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Deskripsi (Indonesia)
            </label>
            <x-tinymce id="deskripsi_id_editor" model="deskripsi_id" />
        </div>

        <div class="border-t"></div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Title (English)
            </label>
            <input type="text" wire:model.defer="title_en" class="w-full px-3 py-2 border focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Description (English)
            </label>
            <x-tinymce id="deskripsi_en_editor" model="deskripsi_en" />
        </div>

        <div class="border-t"></div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Sumber / Reference
            </label>
            <x-tinymce id="sumber_editor" model="sumber" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Tanggal
            </label>
            <input type="date" wire:model.defer="tanggal" class="px-3 py-2 border focus:outline-none">
        </div>

        {{--
        <div>
            <label class="block text-sm font-medium mb-1">
                Image
            </label>
            <input type="file" wire:model="image" class="border">
        </div>
        --}}

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 border font-medium hover:bg-gray-100">
                Simpan
            </button>
        </div>

    </form>

</div>