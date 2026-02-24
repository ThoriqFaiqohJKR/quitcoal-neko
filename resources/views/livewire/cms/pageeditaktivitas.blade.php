<div class="py-12 mx-auto max-w-5xl flex flex-col min-h-screen"
     x-data="{ editing: @entangle('isEditing') }">

    <div class="flex items-center justify-between mb-6">

        <div class="flex items-center gap-2 text-sm">
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

            <span class="text-2xl">Edit Activity</span>
        </div>

        <div class="flex gap-2">
            <template x-if="!editing">
                <button @click="$wire.enableEdit()"
                        type="button"
                        class="px-4 py-2 border hover:bg-black hover:text-white">
                    Edit
                </button>
            </template>

            <template x-if="editing">
                <button @click="$wire.cancelEdit()"
                        type="button"
                        class="px-4 py-2 border hover:bg-gray-100">
                    Batal
                </button>
            </template>
        </div>

    </div>

    <form wire:submit.prevent="update" class="space-y-6">

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold uppercase">Indonesia</h2>

            <input type="text"
                   wire:model="title_id"
                   class="w-full px-3 py-2 border"
                   :disabled="!editing">

            <div class="relative">
                <x-tinymce id="edit_desc_id" model="description_id" />
                <div x-show="!editing"
                     class="absolute inset-0 bg-white/40 cursor-not-allowed"></div>
            </div>

            <div class="relative">
                <x-tinymce id="edit_content_id" model="content_id" />
                <div x-show="!editing"
                     class="absolute inset-0 bg-white/40 cursor-not-allowed"></div>
            </div>

        </div>

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold uppercase">English</h2>

            <input type="text"
                   wire:model="title_en"
                   class="w-full px-3 py-2 border"
                   :disabled="!editing">

            <div class="relative">
                <x-tinymce id="edit_desc_en" model="description_en" />
                <div x-show="!editing"
                     class="absolute inset-0 bg-white/40 cursor-not-allowed"></div>
            </div>

            <div class="relative">
                <x-tinymce id="edit_content_en" model="content_en" />
                <div x-show="!editing"
                     class="absolute inset-0 bg-white/40 cursor-not-allowed"></div>
            </div>

        </div>

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold uppercase">Image</h2>

            @if($oldImage)
                <img src="{{ asset('storage/'.$oldImage) }}"
                     class="w-40 border">
            @endif

            <input type="file"
                   wire:model="image"
                   class="w-full px-3 py-2 border"
                   :disabled="!editing">

            @if($image)
                <div class="mt-3 border w-40 h-40 overflow-hidden">
                    <img src="{{ $image->temporaryUrl() }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

        </div>

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold uppercase">Tanggal Kegiatan</h2>

            <input type="date"
                   wire:model="activity_date"
                   class="border px-3 py-2 w-60"
                   :disabled="!editing">

        </div>

        <div class="border p-5 space-y-4">

            <h2 class="text-sm font-semibold uppercase">Status</h2>

            <select wire:model="status"
                    class="border px-3 py-2 w-40"
                    :disabled="!editing">
                <option value="Y">Y - Aktif</option>
                <option value="N">N - Nonaktif</option>
            </select>

        </div>

        <div class="flex justify-end pt-4" x-show="editing">
            <button type="submit"
                    class="px-4 py-2 border hover:bg-black hover:text-white">
                Update
            </button>
        </div>

    </form>

</div>