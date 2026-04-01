<div x-data="{ open:false, nama:'', deleteId:null }" class="max-w-5xl mx-auto py-12">

    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition
            class="p-3 border bg-green-100 text-green-800 mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-4"> 
        <h2 class="text-lg font-semibold">Check PLTU</h2>

        <div class="flex gap-x-2">
            <a href="{{ route('cms.data.check-pltu.insert', ['locale' => app()->getLocale()]) }}" class="px-4 py-2 bg-blue-600 text-white text-sm">
                Tambah Profil PLTU
            </a> 
        </div>
    </div>

    <div class="border bg-white">

        <div class="grid grid-cols-6 px-3 py-2 bg-gray-100 border-b text-sm font-semibold">
            <div>No</div>
            <div>Nama</div>
            <div>Pulau</div>
            <div>Desa</div>
            <div class="text-center">Status</div>
            <div class="text-center">Aksi</div>
        </div>

        @foreach($profilPltu as $i => $row)
            <div class="grid grid-cols-6 px-3 py-2 border-t text-sm cursor-pointer
                        {{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}
                        hover:bg-blue-50">

                <a href="{{ route('cms.data.check-pltu.detail', ['locale' => app()->getLocale(), 'id' => $row->id]) }}" class="contents">
                    <div>{{ $i + 1 }}</div>
                    <div>{{ $row->nama_pltu }}</div>
                    <div>{{ $row->pulau ?? '-' }}</div>
                    <div>{{ $row->desa ?? '-' }}</div>
                    <div class="text-center">{{ $row->status ?? '-' }}</div>
                </a>

                <div class="text-center">
                    <button
                        @click.stop="
                            open = true;
                            nama = @js($row->nama_pltu);
                            deleteId = {{ $row->id }};
                        "
                        class="text-red-600 text-xs"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        @endforeach

        @if($profilPltu->isEmpty())
            <div class="px-3 py-4 text-center text-gray-500 text-sm">
                Data PLTU belum ada
            </div>
        @endif

    </div>

    <div x-show="open" x-cloak @click="open = false"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">

        <div @click.stop class="bg-white border w-full max-w-sm">
            <div class="px-4 py-2 border-b font-semibold">
                Konfirmasi Hapus
            </div>

            <div class="p-4 text-sm">
                Yakin ingin menghapus
                <span class="font-semibold" x-text="nama"></span>?
            </div>

            <div class="flex justify-end gap-2 px-4 py-3 border-t">
                <button @click="open = false" class="px-3 py-1 border text-sm">
                    Batal
                </button>

                <button
                    @click="open = false"
                    class="px-3 py-1 bg-red-600 text-white text-sm"
                    x-on:click="$wire.deleteId = deleteId; $wire.delete();"
                >
                    Hapus
                </button>
            </div>
        </div>
    </div>

</div>
