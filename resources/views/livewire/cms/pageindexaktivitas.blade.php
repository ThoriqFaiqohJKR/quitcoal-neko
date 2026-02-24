<div class="py-12 mx-auto max-w-5xl flex flex-col min-h-screen">

    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Activity</h1>

            <a href="{{ route('cms.activity.insert', ['locale' => app()->getLocale()]) }}"
               class="px-4 py-2 border font-medium hover:bg-black hover:text-white transition">
                + Tambah Data
            </a>
        </div>

        <input type="text"
               wire:model.live.debounce.300ms="search"
               placeholder="Cari judul atau deskripsi..."
               class="w-full px-3 py-2 border focus:outline-none">
    </div>

    <div class="border mt-4">

        <div class="grid grid-cols-12 bg-gray-100 border-b text-sm font-semibold">
            <div class="col-span-4 px-4 py-3">Judul</div>
            <div class="col-span-4 px-4 py-3">Deskripsi</div>
            <div class="col-span-2 px-4 py-3 text-center">Status</div>
            <div class="col-span-2 px-4 py-3 text-right">Aksi</div>
        </div>

        @forelse ($activitys as $item)

            <div class="grid grid-cols-12 border-b text-sm items-start hover:bg-gray-50 {{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">

                <a href="{{ route('cms.activity.edit', [
                    'locale' => app()->getLocale(),
                    'id' => $item->id
                ]) }}" 
                   class="col-span-10 grid grid-cols-10">

                    <div class="col-span-4 px-4 py-3 font-medium text-gray-900">
                        {{ $item->title_id ?? '-' }}
                    </div>

                    <div class="prose col-span-4 px-4 py-3 text-gray-700 max-w-none">
                        {!! $item->description_id ?? '-' !!}
                    </div>

                    <div class="col-span-2 px-4 py-3 text-center">
                        @if ($item->status === 'Y')
                            <span class="px-2 py-1 text-xs border text-green-600">
                                Aktif
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs border text-red-600">
                                Nonaktif
                            </span>
                        @endif
                    </div>

                </a>

                <div class="col-span-2 px-4 py-3 flex justify-end"
                     x-data="{ open: false }"
                     @click.stop>

                    <button type="button"
                            @click="open = true"
                            class="px-3 py-1 border text-sm hover:bg-red-100 text-red-600">
                        Hapus
                    </button>

                    <div x-show="open"
                         x-transition.opacity
                         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
                         style="display:none">

                        <div @click.outside="open = false"
                             class="bg-white border w-full max-w-sm p-5 text-left">

                            <div class="text-sm font-semibold mb-2">
                                Konfirmasi Hapus
                            </div>

                            <div class="text-sm text-gray-600 mb-5">
                                Yakin ingin menghapus data ini?
                            </div>

                            <div class="flex justify-end gap-2">
                                <button type="button"
                                        @click="open = false"
                                        class="px-3 py-1 border hover:bg-gray-100">
                                    Batal
                                </button>

                                <button type="button"
                                        wire:click="delete({{ $item->id }})"
                                        @click="open = false"
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