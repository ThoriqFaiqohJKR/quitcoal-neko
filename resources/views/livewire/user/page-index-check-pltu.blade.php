<div class="py-32 space-y-12 max-w-5xl mx-auto">
    <div>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">

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

            <!-- Jenis PLTU -->
            <div class="relative border border-gray-200 p-6 bg-white text-center"
                x-data="{ open: false, selected: '', label: 'Semua', color: 'bg-gray-900' }">
                <div class="mb-2 block text-xs text-gray-500">
                    Jenis PLTU
                </div>
                <button type="button"
                    class="flex w-full items-center justify-between border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 outline-none"
                    @click="open = !open">
                    <span class="flex items-center gap-2">
                        <span class="h-3 w-3 rounded-full" :class="color"></span>
                        <span x-text="label"></span>
                    </span>
                    <span class="text-gray-500">⌄</span>
                </button>
                <div x-show="open" @click.outside="open = false" x-cloak
                    class="absolute left-6 right-6 top-24 z-20 border border-gray-300 bg-white text-left shadow-lg">
                    <button type="button"
                        class="flex w-full items-center gap-2 px-3 py-2 text-sm hover:bg-gray-100"
                        @click="selected = ''; label = 'Semua'; color = 'bg-gray-900'; open = false; window.dispatchEvent(new CustomEvent('filter-jenis-pltu', { detail: selected }))">
                        <span class="h-3 w-3 rounded-full bg-gray-900"></span>
                        <span>Semua</span>
                    </button>
                    <button type="button"
                        class="flex w-full items-center gap-2 px-3 py-2 text-sm hover:bg-gray-100"
                        @click="selected = 'captive'; label = 'Captive'; color = 'bg-red-600'; open = false; window.dispatchEvent(new CustomEvent('filter-jenis-pltu', { detail: selected }))">
                        <span class="h-3 w-3 rounded-full bg-red-600"></span>
                        <span>Captive</span>
                    </button>
                    <button type="button"
                        class="flex w-full items-center gap-2 px-3 py-2 text-sm hover:bg-gray-100"
                        @click="selected = 'non captive'; label = 'Non Captive'; color = 'bg-blue-600'; open = false; window.dispatchEvent(new CustomEvent('filter-jenis-pltu', { detail: selected }))">
                        <span class="h-3 w-3 rounded-full bg-blue-600"></span>
                        <span>Non Captive</span>
                    </button>
                    <button type="button"
                        class="flex w-full items-center gap-2 px-3 py-2 text-sm hover:bg-gray-100"
                        @click="selected = 'belum diisi'; label = 'Belum diisi'; color = 'bg-gray-900'; open = false; window.dispatchEvent(new CustomEvent('filter-jenis-pltu', { detail: selected }))">
                        <span class="h-3 w-3 rounded-full bg-gray-900"></span>
                        <span>Belum diisi</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <x-user.peta />
</div>
