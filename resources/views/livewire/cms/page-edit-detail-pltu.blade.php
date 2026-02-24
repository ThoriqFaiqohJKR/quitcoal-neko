<div>
    {{-- Stop trying to control. --}}
    <div class="container mx-auto px-4 max-w-6xl py-12 space-y-8">

        @if (session()->has('success'))
        <div class="border border-green-400 bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
        @endif

        <div class="border border-gray-300 bg-white">
            <div class="border-b px-6 py-4">
                <h5 class="text-lg font-semibold text-gray-800">
                    Edit Detail PLTU
                </h5>
            </div>

            <form wire:submit.prevent="edit" class="grid grid-cols-1 md:grid-cols-2 gap-6 px-6 py-6">

                {{-- Wajib --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Nama PLTU <span class="text-red-600">*</span></label>
                    <select wire:model="id_pltu" required class="mt-1 w-full border border-gray-400 px-3 py-2">
                        <option value="">-- Pilih PLTU --</option>
                        @foreach ($pltu as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_id }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- SEMUA FIELD OPSIONAL → DEFAULT n.a DI BACKEND --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Unit</label>
                    <input wire:model="unit" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Teknologi Pembangkit</label>
                    <input wire:model="teknologi_pembangkit" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <input wire:model="status" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pulau</label>
                    <input wire:model="pulau" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input wire:model="lokasi" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                    <input wire:model="kabupaten" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Desa</label>
                    <input wire:model="desa" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas (MW)</label>
                    <input type="number" wire:model="kapasitas" class="mt-1 w-full border border-gray-400 px-3 py-2" inputmode="numeric" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konsumsi Batubara / Tahun</label>
                    <input wire:model="konsumsi_batubara" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tahun Pembangunan</label>
                    <input type="number" wire:model="tahun_pembangunan" class="mt-1 w-full border border-gray-400 px-3 py-2" inputmode="numeric" maxlength="4" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mulai Beroperasi</label>
                    <input type="number" wire:model="beroperasi" class="mt-1 w-full border border-gray-400 px-3 py-2" inputmode="numeric" maxlength="4" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Berakhir Operasi</label>
                    <input type="number" wire:model="berakhir" class="mt-1 w-full border border-gray-400 px-3 py-2" inputmode="numeric" maxlength="4" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mata Uang Investasi</label>
                    <input wire:model="mata_uang_investasi" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nilai Investasi</label>
                    <input type="number" wire:model="nilai_investasi" class="mt-1 w-full border border-gray-400 px-3 py-2" inputmode="numeric" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Program Pemerintah</label>
                    <input wire:model="program_pemerintah" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Lembaga Pemberi Pinjaman</label>
                    <input wire:model="lembanga_pemberi" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pinjaman</label>
                    <input wire:model="pinjaman" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mata Uang Pinjaman</label>
                    <input wire:model="mata_uang_pinjaman" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nilai Pinjaman</label>
                    <input type="number" wire:model="nilai_pinjaman" class="mt-1 w-full border border-gray-400 px-3 py-2" inputmode="numeric" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pengelolaan</label>
                    <input wire:model="pengelolaan" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Owner</label>
                    <input wire:model="owner" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pengelola</label>
                    <input wire:model="pengelola" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Kontraktor Konstruksi</label>
                    <input wire:model="kontraktor_konstruksi" class="mt-1 w-full border border-gray-400 px-3 py-2" placeholder="n.a">
                </div>

                <div class="md:col-span-2 flex justify-between pt-6">
                    <a href="#" class="border border-gray-400 px-4 py-2 text-sm font-semibold text-gray-700">Kembali</a>
                    <button type="submit"
                        class="border border-blue-600 bg-blue-600 px-6 py-2 text-sm font-semibold text-white">
                        Update
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>
