<div class="max-w-5xl mx-auto py-12" x-data="{ lang: 'id' }">

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition
            class="mb-4 border p-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-4 gap-6">

        <div class="col-span-1 space-y-2">
            <button type="button" @click="lang = 'id'" :class="lang === 'id' ? 'bg-black text-white' : ''"
                class="w-full border p-2">
                Indonesia
            </button>

            <button type="button" @click="lang = 'en'" :class="lang === 'en' ? 'bg-black text-white' : ''"
                class="w-full border p-2">
                English
            </button>
        </div>

        <div class="col-span-3 border-l pl-6 space-y-6">

            <!-- TITLE -->
            <div>
                <div class="text-xs font-semibold mb-2 uppercase tracking-wide">
                    <span x-show="lang === 'id'">Judul</span>
                    <span x-show="lang === 'en'">Title</span>
                </div>

                <input x-show="lang === 'id'" type="text" class="w-full border p-2" wire:model.defer="title_id" />

                <input x-show="lang === 'en'" type="text" class="w-full border p-2" wire:model.defer="title_en" />
            </div>

            <!-- DESCRIPTION -->
            <div>
                <div class="text-xs font-semibold mb-2 uppercase tracking-wide">
                    <span x-show="lang === 'id'">Deskripsi</span>
                    <span x-show="lang === 'en'">Description</span>
                </div>

                <div x-cloak x-show="lang === 'id'">
                    <x-tinymce id="about_desc_id" model="description_id" />
                </div>

                <div x-cloak x-show="lang === 'en'">
                    <x-tinymce id="about_desc_en" model="description_en" />
                </div>
            </div>

            <!-- CONTENT -->
            <div>
                <div class="text-xs font-semibold mb-2 uppercase tracking-wide">
                    <span x-show="lang === 'id'">Konten</span>
                    <span x-show="lang === 'en'">Content</span>
                </div>

                <div x-cloak x-show="lang === 'id'">
                    <x-tinymce id="about_content_id" model="content_id" />
                </div>

                <div x-cloak x-show="lang === 'en'">
                    <x-tinymce id="about_content_en" model="content_en" />
                </div>
            </div>

        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button type="button" wire:click="save" class="border px-6 py-2 hover:bg-black hover:text-white transition">
            Simpan
        </button>
    </div>

</div>