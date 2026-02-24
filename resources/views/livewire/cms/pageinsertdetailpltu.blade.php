<div class="max-w-5xl mx-auto py-12">

    <div class="mb-4 text-xl text-gray-600 flex items-center gap-2">
        <a href="{{ route('cms.data.check-pltu.index') }}">
            CHECK PLTU
        </a>

        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>

        <p class="font-semibold text-gray-900">Insert Detail PLTU</p>
    </div>

    <div class="border bg-white">

        <div class="px-4 py-2 border-b font-semibold flex items-center justify-between">
            <div>Form Detail PLTU</div>
        </div>

        <div class="p-4 grid grid-cols-2 gap-x-6 gap-y-4 text-sm">

            <div>PLTU</div>
            <div>
                <select wire:model="id_pltu" class="w-full border px-3 py-2 outline-none bg-white">
                    <option value="">-- Pilih PLTU --</option>

                    @foreach ($listPltu as $row)
                        <option value="{{ $row->id }}">
                            {{ $row->nama_pltu }}
                        </option>
                    @endforeach
                </select>

                @error('id_pltu')
                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>Nama Pembangkit</div>
            <div>
                <input type="text" wire:model="nama_pembangkit" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Nama Unit</div>
            <div>
                <input type="text" wire:model="nama_unit" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Pemilik</div>
            <div>
                <input type="text" wire:model="pemilik" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Pemilik Detail</div>
            <div>
                <input type="text" wire:model="pemilik_detail" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Kapasitas (MW)</div>
            <div>
                <input type="text" wire:model="kapasitas" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Status</div>
            <div>
                <input type="text" wire:model="status" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Start Year</div>
            <div>
                <input type="number" wire:model="start_year" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Combustion Technology</div>
            <div>
                <input type="text" wire:model="combustion_technology" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Coal Type</div>
            <div>
                <input type="text" wire:model="coal_type" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Coal Source</div>
            <div>
                <input type="text" wire:model="coal_source" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Alternate Fuel</div>
            <div>
                <input type="text" wire:model="alternate_fuel" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Location</div>
            <div>
                <input type="text" wire:model="location" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Local Area</div>
            <div>
                <input type="text" wire:model="local_area" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Major Area</div>
            <div>
                <input type="text" wire:model="major_area" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Subnational Unit</div>
            <div>
                <input type="text" wire:model="subnational_unit" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Captive</div>
            <div>
                <select wire:model="captive" class="w-full border px-3 py-2 outline-none bg-white">
                    <option value="0">Tidak</option>
                    <option value="1">Ya</option>
                </select>
            </div>

            <div>Captive Industry Use</div>
            <div>
                <input type="text" wire:model="captive_industry_use" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Captive Residential Use</div>
            <div>
                <input type="text" wire:model="captive_residential_use" class="w-full border px-3 py-2 outline-none">
            </div>

            <div>Plant Age (Years)</div>
            <div>
                <input type="number" wire:model="plant_age_years" class="w-full border px-3 py-2 outline-none">
            </div>

        </div>

        <div class="p-4 border-t flex justify-end gap-2">
            <a href="{{ route('cms.data.check-pltu.index') }}"
                class="px-4 py-2 border bg-white text-black hover:bg-black hover:text-white">
                Batal
            </a>

            <button wire:click="save" class="px-4 py-2 border bg-black text-white hover:bg-white hover:text-black">
                Simpan
            </button>
        </div>

    </div>
</div>
