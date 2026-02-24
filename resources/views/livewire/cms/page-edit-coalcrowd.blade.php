<div class="py-12 space-y-6">

    <div class="flex justify-between items-center">
        <div class="flex items-center gap-2 text-xl font-semibold">

    <a href="{{ route('cms.background.coalcrowd.index', ['locale' => app()->getLocale()]) }}"
       class="text-black hover:underline">
        Coalcrowd
    </a>

    {{-- Heroicon: Chevron Right --}}
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5 text-gray-500"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         stroke-width="2">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 5l7 7-7 7" />
    </svg>

    <span class="px-2 py-1 text-sm bg-black text-white">
        Edit Coalcrowd
    </span>

</div>


        @if (!$isEdit)
            <button wire:click="enableEdit" class="px-4 py-2 border font-medium hover:bg-gray-100">
                Edit
            </button>
        @endif
    </div>

    @if (session()->has('success'))
        <div class="border p-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">

        <div>
            <label class="block text-sm font-medium mb-1">
                Judul (Indonesia)
            </label>
            <input type="text" wire:model.defer="title_id" @disabled(!$isEdit)
                class="w-full px-3 py-2 border focus:outline-none disabled:bg-gray-100">
        </div>

        <div class="relative">
            <x-tinymce id="deskripsi_id_editor" model="deskripsi_id" />
            Deskripsi (Indonesia)
            @if (!$isEdit)
                <div class="absolute inset-0 z-10 bg-transparent cursor-not-allowed"></div>
            @endif
        </div>


        <div class="border-t"></div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Title (English)
            </label>
            <input type="text" wire:model.defer="title_en" @disabled(!$isEdit)
                class="w-full px-3 py-2 border focus:outline-none disabled:bg-gray-100">
        </div>

        <div class="relative">
            <x-tinymce id="deskripsi_en_editor" model="deskripsi_en" />
            Deskripsi English
            @if (!$isEdit)
                <div class="absolute inset-0 z-10 bg-transparent cursor-not-allowed"></div>
            @endif
        </div>


        <div class="border-t"></div>

        <div class="relative">
            <x-tinymce id="sumber_editor" model="sumber" />
            Sumber / Reference
            @if (!$isEdit)
                <div class="absolute inset-0 z-10 bg-transparent cursor-not-allowed"></div>
            @endif
        </div>


        <div>
            <label class="block text-sm font-medium mb-1">
                Tanggal
            </label>
            <input type="date" wire:model.defer="tanggal" @disabled(!$isEdit)
                class="px-3 py-2 border focus:outline-none disabled:bg-gray-100">
        </div>

        @if ($isEdit)
            <div class="flex gap-2 pt-4 border-t">
                <button type="submit" class="px-4 py-2 border font-medium hover:bg-gray-100">
                    Simpan
                </button>
            </div>
        @endif

    </form>

</div>