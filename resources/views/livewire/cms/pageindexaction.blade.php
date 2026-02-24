<div class="py-12 mx-auto max-w-5xl flex flex-col min-h-screen">

    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Action</h1>

            <a href="{{ route('cms.action.insert', ['locale' => app()->getLocale()]) }}"
                class="px-4 py-2 border font-medium hover:bg-gray-100">
                + Tambah Data
            </a>
        </div>

        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul atau deskripsi..."
            class="w-full px-3 py-2 border focus:outline-none">
    </div>

    <div class="border mt-4">

        <!-- HEADER -->
        <div class="grid grid-cols-12 bg-gray-100 border-b text-sm font-semibold text-gray-700">
            <div class="col-span-4 px-4 py-3">Judul</div>
            <div class="col-span-4 px-4 py-3">Deskripsi</div>
            <div class="col-span-2 px-4 py-3 text-center">Status</div>
            <div class="col-span-2 px-4 py-3 text-right">Aksi</div>
        </div>

        @forelse ($actions as $item)

                <div
                    class="grid grid-cols-12 border-b text-sm items-center hover:bg-gray-50 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">

                    <!-- Area Klik Edit -->
                    <a href="{{ route('cms.action.edit', [
                'locale' => app()->getLocale(),
                'id' => $item->id
            ]) }}" class="col-span-10 grid grid-cols-10 items-center">

                        <!-- Judul -->
                        <div class="col-span-4 px-4 py-4 font-medium text-gray-900">
                            {{ $item->judul_id ?? '-' }}
                        </div>

                        <div class="col-span-4 px-4 py-4 text-gray-600 text-sm">
                            <div class="line-clamp-2 wrap-break-word">
                                {{ strip_tags($item->deskripsi_id ?? '-') }}
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-span-2 px-4 py-4 flex justify-center">
                            @if($item->status === 'Y')
                                <div class="px-3 py-1 text-xs font-semibold border border-green-600 text-green-700 bg-green-50">
                                    AKTIF
                                </div>
                            @else
                                <div class="px-3 py-1 text-xs font-semibold border border-red-600 text-red-700 bg-red-50">
                                    NONAKTIF
                                </div>
                            @endif
                        </div>

                    </a>

                    <!-- Aksi -->
                    <div class="col-span-2 px-4 py-4 flex justify-end" x-data="{ open: false }" @click.stop>

                        <button type="button" @click="open = true"
                            class="px-4 py-1 border text-sm font-medium text-red-600 hover:bg-red-50">
                            Hapus
                        </button>

                        <!-- Modal -->
                        <div x-show="open" x-transition.opacity
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display:none">

                            <div @click.outside="open = false" class="bg-white border w-full max-w-sm p-6">

                                <div class="text-sm font-semibold mb-2">
                                    Konfirmasi Hapus
                                </div>

                                <div class="text-sm text-gray-600 mb-6">
                                    Yakin ingin menghapus data ini?
                                </div>

                                <div class="flex justify-end gap-3">
                                    <button type="button" @click="open = false" class="px-4 py-1 border hover:bg-gray-100">
                                        Batal
                                    </button>

                                    <button type="button" wire:click="delete({{ $item->id }})" @click="open = false"
                                        class="px-4 py-1 border text-red-600 hover:bg-red-50">
                                        Ya, Hapus
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

        @empty
            <div class="py-10 text-center text-gray-400 text-sm">
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