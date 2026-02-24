<div class="py-12 mx-auto max-w-5xl flex flex-col min-h-screen">

    <div class="flex items-center gap-2 mb-6 text-sm">

        <a href="{{ route('cms.ngopini.index', ['locale' => app()->getLocale()]) }}" class="font-medium hover:underline text-2xl">
            Ngopini
        </a>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-2xl">
            Insert Ngopini
        </span>

    </div>

    <form wire:submit.prevent="store" class="space-y-6">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                Indonesia
            </h2>

            <div>
                <label class="block text-sm font-medium mb-1">Judul (ID)</label>
                <input type="text" wire:model="judul_id" class="w-full px-3 py-2 border focus:outline-none">

                @error('judul_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Deskripsi (ID)</label>
                <x-tinymce id="deskripsi_id_editor" model="deskripsi_id" />

                @error('deskripsi_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Isi (ID)</label>
                <x-tinymce id="isi_id_editor" model="isi_id" />

                @error('isi_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Upload Flayer / Gambar (ID)</label>
                <input type="file" wire:model="flayer_id" accept="image/*"
                    class="w-full px-3 py-2 border focus:outline-none">

                @error('flayer_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror

                <div wire:loading wire:target="flayer_id" class="text-sm text-gray-500 mt-1">
                    Uploading...
                </div>

                @if ($flayer_id)
                    <div class="mt-3 border w-40 h-40 overflow-hidden">
                        <img src="{{ $flayer_id->temporaryUrl() }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

        </div>

        <hr class="border-gray-300">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                English
            </h2>

            <div>
                <label class="block text-sm font-medium mb-1">Title (EN)</label>
                <input type="text" wire:model="judul_en" class="w-full px-3 py-2 border focus:outline-none"
                    placeholder="Jika kosong akan mengikuti judul ID">

                @error('judul_en')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description (EN)</label>
                <x-tinymce id="deskripsi_en_editor" model="deskripsi_en" />

                @error('deskripsi_en')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Content (EN)</label>
                <x-tinymce id="isi_en_editor" model="isi_en" />

                @error('isi_en')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Upload Flayer / Image (EN)</label>
                <input type="file" wire:model="flayer_en" accept="image/*"
                    class="w-full px-3 py-2 border focus:outline-none">

                @error('flayer_en')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror

                <div wire:loading wire:target="flayer_en" class="text-sm text-gray-500 mt-1">
                    Uploading...
                </div>

                @if ($flayer_en)
                    <div class="mt-3 border w-40 h-40 overflow-hidden">
                        <img src="{{ $flayer_en->temporaryUrl() }}" class="w-full h-full object-cover">
                    </div>
                @elseif ($flayer_id)
                    <div class="mt-3 border w-40 h-40 overflow-hidden">
                        <img src="{{ $flayer_id->temporaryUrl() }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

        </div>

        <div class="flex justify-end gap-2 pt-4">

            <button type="submit" class="px-4 py-2 border font-medium hover:bg-black hover:text-white">
                Simpan
            </button>
        </div>

    </form>

</div>