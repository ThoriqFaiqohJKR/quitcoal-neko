<div class="py-12 mx-auto max-w-5xl flex flex-col space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-xl font-semibold">Benchmark Price</h1>

        <button wire:click="save" class="px-4 py-2 border font-medium hover:bg-gray-100">
            Simpan
        </button>
    </div>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition
            class="border p-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif


    <div class="space-y-4">

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
            <x-tinymce id="description_id_editor" model="description_id" />
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
            <x-tinymce id="description_en_editor" model="description_en" />
        </div>

        {{--
        <div>
            <label class="block text-sm font-medium mb-1">
                Tanggal
            </label>
            <input type="date" wire:model.defer="tanggal" class="px-3 py-2 border focus:outline-none">
        </div>
        --}}

    </div>

</div>