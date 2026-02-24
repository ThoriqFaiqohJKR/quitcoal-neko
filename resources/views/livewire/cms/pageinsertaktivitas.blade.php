<div class="py-12 mx-auto max-w-5xl flex flex-col min-h-screen">

    <div class="flex items-center gap-2 mb-6 text-sm">

        <a href="{{ route('cms.activity.index', ['locale' => app()->getLocale()]) }}"
           class="font-medium hover:underline text-2xl">
            Activity
        </a>

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             class="w-4 h-4">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-2xl">
            Insert Activity
        </span>

    </div>

    <form wire:submit.prevent="save" class="space-y-6">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                Indonesia
            </h2>

            <div>
                <label class="block text-sm font-medium mb-1">Judul (ID)</label>
                <input type="text"
                       wire:model="title_id"
                       class="w-full px-3 py-2 border focus:outline-none">

                @error('title_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Deskripsi (ID)</label>
                <x-tinymce id="activity_desc_id_editor" model="description_id" />
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Isi (ID)</label>
                <x-tinymce id="activity_content_id_editor" model="content_id" />
            </div>

        </div>

        <hr class="border-gray-300">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                English
            </h2>

            <div>
                <label class="block text-sm font-medium mb-1">Title (EN)</label>
                <input type="text"
                       wire:model="title_en"
                       class="w-full px-3 py-2 border focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description (EN)</label>
                <x-tinymce id="activity_desc_en_editor" model="description_en" />
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Content (EN)</label>
                <x-tinymce id="activity_content_en_editor" model="content_en" />
            </div>

        </div>

        <hr class="border-gray-300">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                Image
            </h2>

            <input type="file"
                   wire:model="image"
                   accept="image/*"
                   class="w-full px-3 py-2 border focus:outline-none">

            @error('image')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror

            <div wire:loading wire:target="image"
                 class="text-sm text-gray-500">
                Uploading...
            </div>

            @if ($image)
                <div class="mt-3 border w-40 h-40 overflow-hidden">
                    <img src="{{ $image->temporaryUrl() }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

        </div>

        <hr class="border-gray-300">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                Tanggal Kegiatan
            </h2>

            <input type="date"
                   wire:model="activity_date"
                   class="border px-3 py-2 w-60">

            @error('activity_date')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror

        </div>

        <hr class="border-gray-300">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                Status
            </h2>

            <select wire:model="status"
                    class="border px-3 py-2 w-40">
                <option value="Y">Y - Aktif</option>
                <option value="N">N - Nonaktif</option>
            </select>

        </div>

        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="px-4 py-2 border font-medium hover:bg-black hover:text-white">
                Simpan
            </button>
        </div>

    </form>

</div>