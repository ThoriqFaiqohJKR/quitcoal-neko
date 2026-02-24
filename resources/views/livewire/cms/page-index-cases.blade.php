<div class="py-12 mx-auto max-w-5xl flex flex-col">

    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold">Cases</h1>

            <a href="{{ route('cms.coal-ruption.cases.insert', ['locale' => app()->getLocale()]) }}"
                class="px-4 py-2 border font-medium hover:bg-gray-100">
                + Tambah Data
            </a>
        </div>

        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul / deskripsi..."
            class="w-full px-3 py-2 border focus:outline-none">
    </div>

    <div class="border mt-4">
        <div class="grid grid-cols-12 bg-gray-100 border-b text-sm font-medium">
            <div class="col-span-3 px-3 py-2">Judul</div>
            <div class="col-span-5 px-3 py-2">Deskripsi</div>
            <div class="col-span-2 px-3 py-2">Status</div>
            <div class="col-span-2 px-3 py-2 text-center">Aksi</div>
        </div>

        @forelse ($cases as $item)
                <div
                    class="relative grid grid-cols-12 border-b text-sm items-start hover:bg-gray-50 {{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">

                    <a href="{{ route('cms.coal-ruption.cases.edit', [
                'locale' => app()->getLocale(),
                'id' => $item->id
            ]) }}" class="absolute inset-0 z-30"></a>

                    <div class="col-span-3 px-3 py-2 font-medium relative z-20">
                        {{ app()->getLocale() === 'en'
                ? ($item->title_en ?? '-')
                : ($item->title_id ?? '-') }}
                    </div>

                    <div class="col-span-5 px-3 py-2 prose prose-p:m-0 text-gray-700 relative z-20">
                        {!! ($this->descriptionPreview)($item) !!}
                    </div>

                    <div class="col-span-2 px-3 py-2 prose prose-p:m-0 prose-a:underline prose-a:text-blue-600 relative z-20">
                        @if($item->status === 'Y')
                            <span class="px-2 py-1 text-xs border bg-green-100 text-green-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs border bg-red-100 text-red-700">Nonaktif</span>
                        @endif
                    </div>

                    <div class="col-span-2 px-3 py-2 text-center relative z-30" x-data="{ open: false }" @click.stop>

                        <button type="button" @click="open = true" class="px-2 py-1 border hover:bg-red-100">
                            Hapus
                        </button>

                        <div x-show="open" x-transition.opacity
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display:none">

                            <div @click.outside="open = false" class="bg-white border w-full max-w-sm p-4 text-left">

                                <div class="text-sm font-semibold mb-2">
                                    Konfirmasi Hapus
                                </div>

                                <div class="text-sm text-gray-600 mb-4">
                                    Yakin ingin menghapus data ini?
                                </div>

                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false" class="px-3 py-1 border hover:bg-gray-100">
                                        Batal
                                    </button>

                                    <button type="button" wire:click="delete({{ $item->id }})" @click="open = false"
                                        class="px-3 py-1 border hover:bg-red-100 text-red-600">
                                        Ya, Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        @empty
            <div class="py-6 text-center text-gray-500 text-sm">
                Data kosong
            </div>
        @endforelse
    </div>

    <div class="mt-auto pt-6">
        @include('components.pagination', [
            'page' => $page,
            'lastPage' => $lastPage
        ])
    </div>

</div>
