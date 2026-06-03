<div class="py-32 space-y-12 max-w-5xl mx-auto">
    <div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            <!-- Daftar PLTU -->
            <div class="border border-gray-200 p-6 bg-white text-center">
                <div class="text-gray-500 text-xs mb-2">Daftar PLTU</div>
                <div class="text-gray-900 font-semibold text-xl">
                    128
                </div>
            </div>
 
            <!-- Provinsi -->
            <div class="border border-gray-200 p-6 bg-white text-center">
                <div class="text-gray-500 text-xs mb-2">Provinsi</div>
                <div class="text-gray-900 font-semibold text-xl">
                    23
                </div>
            </div>

            <!-- Total Kapasitas -->
            <div class="border border-gray-200 p-6 bg-white text-center">
                <div class="text-gray-500 text-xs mb-2">Total Kapasitas</div>
                <div class="text-gray-900 font-semibold text-xl">
                    45.320 MW
                </div>
            </div>

            <!-- Jumlah Investasi -->
            <div class="border border-gray-200 p-6 bg-white text-center">
                <div class="text-gray-500 text-xs mb-2">Jumlah Investasi</div>
                <div class="text-gray-900 font-semibold text-xl">
                    Rp 320 T
                </div>
            </div>

        </div>
    </div>
    <div class="border border-gray-200 bg-white p-6">
        <label for="jenis-pltu-filter" class="mb-2 block text-xs uppercase tracking-[2px] text-gray-500">
            Jenis PLTU
        </label>
        <select id="jenis-pltu-filter"
            class="w-full border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none md:max-w-xs"
            x-data
            @change="window.dispatchEvent(new CustomEvent('filter-jenis-pltu', { detail: $event.target.value }))">
            <option value="">Semua PLTU</option>
            <option value="captive">Captive</option>
            <option value="non captive">Non Captive</option>
        </select>
        <div class="mt-4 flex flex-wrap gap-4 text-xs text-gray-600">
            <div class="flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-red-600"></span>
                <span>Captive</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-blue-600"></span>
                <span>Non Captive</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-gray-900"></span>
                <span>Belum diisi</span>
            </div>
        </div>
    </div>
    <x-user.peta />
</div>
