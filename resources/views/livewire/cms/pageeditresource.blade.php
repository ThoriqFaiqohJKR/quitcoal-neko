<div class="py-12 mx-auto max-w-5xl flex flex-col min-h-screen">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-semibold">Edit Resource</h1>

        <a href="{{ route('cms.data.resource.index', ['locale' => app()->getLocale()]) }}"
            class="px-4 py-2 border font-medium hover:bg-gray-100">
            Kembali
        </a>
    </div>

    @if (session()->has('success'))
        <div class="border border-green-400 bg-green-50 text-green-700 px-4 py-3 mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-6">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                Indonesia
            </h2>

            <div>
                <label class="block text-sm font-medium mb-1">Title (ID)</label>
                <input type="text" wire:model="title_id"
                    class="w-full px-3 py-2 border focus:outline-none">

                @error('title_id')
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

            @if ($old_file_id)
                <div class="text-sm">
                    <span class="font-medium">File Lama (ID):</span>
                    <a href="{{ asset('storage/' . $old_file_id) }}" target="_blank"
                        class="text-blue-600 underline">
                        Download PDF
                    </a>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium mb-1">Upload File PDF Baru (ID)</label>
                <input type="file" wire:model="file_id" accept="application/pdf"
                    class="w-full px-3 py-2 border focus:outline-none">

                @error('file_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror

                <div wire:loading wire:target="file_id" class="text-sm text-gray-500 mt-1">
                    Uploading...
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Nama File Baru (ID) (optional)</label>
                <input type="text" wire:model="file_name_id"
                    class="w-full px-3 py-2 border focus:outline-none"
                    placeholder="contoh: peraturan-mangrove-2024">

                @error('file_name_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <hr class="border-gray-300">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold text-gray-700 uppercase">
                English
            </h2>

            <div>
                <label class="block text-sm font-medium mb-1">Title (EN)</label>
                <input type="text" wire:model="title_en"
                    class="w-full px-3 py-2 border focus:outline-none">

                @error('title_en')
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

            @if ($old_file_en)
                <div class="text-sm">
                    <span class="font-medium">Old File (EN):</span>
                    <a href="{{ asset('storage/' . $old_file_en) }}" target="_blank"
                        class="text-blue-600 underline">
                        Download PDF
                    </a>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium mb-1">Upload File PDF Baru (EN)</label>
                <input type="file" wire:model="file_en" accept="application/pdf"
                    class="w-full px-3 py-2 border focus:outline-none">

                @error('file_en')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror

                <div wire:loading wire:target="file_en" class="text-sm text-gray-500 mt-1">
                    Uploading...
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">File Name Baru (EN) (optional)</label>
                <input type="text" wire:model="file_name_en"
                    class="w-full px-3 py-2 border focus:outline-none"
                    placeholder="example: mangrove-regulation-2024">

                @error('file_name_en')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('cms.data.resource.index', ['locale' => app()->getLocale()]) }}"
                class="px-4 py-2 border hover:bg-gray-100">
                Batal
            </a>

            <button type="submit"
                class="px-4 py-2 border font-medium hover:bg-gray-100">
                Update
            </button>
        </div>

    </form>

</div>
