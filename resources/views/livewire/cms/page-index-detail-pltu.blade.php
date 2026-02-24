<div class="container mx-auto px-4 max-w-6xl py-12">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Data Detail PLTU
        </h1>

        <a href="{{ route('cms.detail-pltu.insert') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Tambah
        </a>
    </div>

    {{-- FLASH --}}
    @if (session()->has('success'))
    <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">
        {{ session('success') }}
    </div>
    @endif

    {{-- LIST --}}
    <div class="bg-white rounded-xl shadow divide-y">

        @forelse ($detail as $row)
        <div class="relative flex items-center justify-between p-4 hover:bg-gray-50 transition">

            {{-- OVERLAY LINK (KLIK CARD = EDIT) --}}
            <a href="{{ route('cms.detail-pltu.edit', $row->id) }}"
                class="absolute inset-0 z-0"
                aria-label="Edit Detail PLTU"></a>

            {{-- LEFT --}}
            <div class="relative z-10 flex flex-col gap-1 pointer-events-none">
                <p class="text-base font-semibold text-gray-800">
                    {{ $row->nama_pltu ?? 'n.a' }}
                </p>

                <p class="text-sm text-gray-500">
                    Unit: {{ $row->unit ?? 'n.a' }} ·
                    Lokasi: {{ $row->lokasi ?? 'n.a' }}
                </p>

                <div class="flex items-center gap-2 mt-1">
                    <span class="px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-700">
                        {{ $row->status ?? 'n.a' }}
                    </span>

                    <span class="text-xs text-gray-600">
                        Kapasitas: {{ $row->kapasitas ?? 'n.a' }}
                    </span>
                </div>
            </div>

            {{-- RIGHT (BUTTONS) --}}
            <div class="relative z-10 flex items-center gap-2 pointer-events-auto">

                {{-- EDIT --}}
                <a href="{{ route('cms.detail-pltu.edit', $row->id) }}"
                    class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    title="Edit">
                    {{-- Heroicon: Pencil --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 012.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l9.932-9.93z" />
                    </svg>
                </a>

                {{-- HAPUS --}}
                <button
                    type="button"
                    wire:click="delete({{ $row->id }})"
                    onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()"
                    class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                    title="Hapus">
                    {{-- Heroicon: Trash --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7M9 7h6M10 11v6M14 11v6" />
                    </svg>
                </button>

            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-500">
            Data detail PLTU belum tersedia
        </div>
        @endforelse

        {{-- PAGINATION --}}
        <div class="mt-8">
            @include('pagination.custom', [
            'page' => $page,
            'lastPage' => $lastPage
            ])
        </div>

    </div>
</div>
