<div class="mx-auto max-w-5xl">
    <div class="flex border-y max-h-5xl">

        <aside class="w-1/4 border-r bg-gray-50 p-4 space-y-2">
            @php
                $menu = [
                    'profil' => 'Profil PLTU',
                    'overview' => 'Overview',
                    'corporate' => 'Corporate',
                    'environment' => 'Environment',
                    'spotlight' => 'Spotlight',
                    'lokasi' => 'Titik Lokasi',
                ];
            @endphp

            @foreach($menu as $key => $label)
                <button @if($key === 'lokasi') wire:click="setMenuLokasi" @else wire:click="$set('activeMenu','{{ $key }}')"
                @endif
                    class="w-full text-left px-3 py-2 {{ $activeMenu === $key ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                    {{ $label }}
                </button>
            @endforeach
        </aside>

        <main class="w-3/4 p-6 overflow-auto">

            @if($activeMenu === 'profil')
                <h2 class="font-bold text-lg mb-4">Edit Profil PLTU</h2>

                <input type="file" wire:model="image" class="w-full border p-2 mb-3">

                @if ($image)
                    <div class="aspect-square max-w-xs border mb-3 overflow-hidden">
                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                    </div>
                @elseif(!empty($oldImage))
                    <div class="aspect-square max-w-xs border mb-3 overflow-hidden">
                        <img src="{{ asset('storage/' . $oldImage) }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <input wire:model="nama_pltu" class="w-full border p-2 mb-3" placeholder="Nama PLTU">
                <input wire:model="unit" class="w-full border p-2 mb-3" placeholder="Unit">

                <input wire:model="teknologi_pembangkit" class="w-full border p-2 mb-3" placeholder="Teknologi Pembangkit">
                <input wire:model="status" class="w-full border p-2 mb-3" placeholder="Status">

                <input step="0.01" wire:model="kapasitas" class="w-full border p-2 mb-3" placeholder="Kapasitas (MW)">
                <input wire:model="konsumsi_batubara_tahun" class="w-full border p-2 mb-3"
                    placeholder="Konsumsi Batubara / Tahun">

                <input wire:model="tahun_pembangunan" class="w-full border p-2 mb-3" placeholder="Tahun Pembangunan">
                <input wire:model="beroperasi" class="w-full border p-2 mb-3" placeholder="Beroperasi (Tahun)">
                <input wire:model="berakhir" class="w-full border p-2 mb-3" placeholder="Berakhir (Tahun)">

                <input wire:model="mata_uang_nilai_investasi" class="w-full border p-2 mb-3"
                    placeholder="Mata Uang Nilai Investasi">
                <input step="0.01" wire:model="nilai_investasi" class="w-full border p-2 mb-3"
                    placeholder="Nilai Investasi">

                <input wire:model="program_pemerintah" class="w-full border p-2 mb-3" placeholder="Program Pemerintah">

                <input wire:model="lembaga_pemberi_pinjaman" class="w-full border p-2 mb-3"
                    placeholder="Lembaga Pemberi Pinjaman">
                <input wire:model="pinjaman" class="w-full border p-2 mb-3" placeholder="Pinjaman">

                <input wire:model="mata_uang_nilai_pinjaman" class="w-full border p-2 mb-3"
                    placeholder="Mata Uang Nilai Pinjaman">
                <input step="0.01" wire:model="nilai_pinjaman" class="w-full border p-2 mb-3" placeholder="Nilai Pinjaman">

                <input wire:model="pengelolaan_1" class="w-full border p-2 mb-3" placeholder="Pengelolaan 1">
                <input wire:model="pengelolaan_2" class="w-full border p-2 mb-3" placeholder="Pengelolaan 2">

                <input wire:model="pengelola" class="w-full border p-2 mb-3" placeholder="Pengelola">
                <input wire:model="kontraktor_konstruksi" class="w-full border p-2 mb-3"
                    placeholder="Kontraktor Konstruksi">

                <input wire:model="combustion_technology" class="w-full border p-2 mb-3"
                    placeholder="Combustion Technology">
                <input wire:model="coal_type" class="w-full border p-2 mb-3" placeholder="Coal Type">
                <input wire:model="coal_source" class="w-full border p-2 mb-3" placeholder="Coal Source">
                <input wire:model="alternate_fuel" class="w-full border p-2 mb-3" placeholder="Alternate Fuel">

                <input wire:model="captive" class="w-full border p-2 mb-3" placeholder="Captive">
                <input wire:model="captive_industry_use" class="w-full border p-2 mb-3" placeholder="Captive Industry Use">
                <input wire:model="captive_residential_use" class="w-full border p-2 mb-3"
                    placeholder="Captive Residential Use">

                <input wire:model="plant_age_years" class="w-full border p-2 mb-3" placeholder="Plant Age (Years)">
                <textarea wire:model="reference" class="w-full border p-2 mb-3" placeholder="Reference"></textarea>
            @endif

            @if($activeMenu === 'overview')
                <h2 class="font-bold text-lg mb-2">Overview (ID)</h2>
                <x-tinymce id="overview_id_editor" model="overview_id" />

                <h2 class="font-bold text-lg mt-6 mb-2">Overview (EN)</h2>
                <x-tinymce id="overview_en_editor" model="overview_en" />
            @endif

            @if($activeMenu === 'corporate')
                <h2 class="font-bold text-lg mt-6 mb-2">Corporate (ID)</h2>
                <x-tinymce id="corporate_id_editor" model="corporate_id" />

                <h2 class="font-bold text-lg mt-6 mb-2">Corporate (EN)</h2>
                <x-tinymce id="corporate_en_editor" model="corporate_en" />
            @endif

            @if($activeMenu === 'environment')
                <h2 class="font-bold text-lg mt-6 mb-2">Environment (ID)</h2>
                <x-tinymce id="environment_id_editor" model="environment_id" />

                <h2 class="font-bold text-lg mt-6 mb-2">Environment (EN)</h2>
                <x-tinymce id="environment_en_editor" model="environment_en" />
            @endif

            @if($activeMenu === 'spotlight')
                <h2 class="font-bold text-lg mt-6 mb-2">Spotlight (ID)</h2>
                <x-tinymce id="spotlight_id_editor" model="spotlight_id" />

                <h2 class="font-bold text-lg mt-6 mb-2">Spotlight (EN)</h2>
                <x-tinymce id="spotlight_en_editor" model="spotlight_en" />
            @endif

            @if($activeMenu === 'lokasi')
                <h2 class="font-bold text-lg mb-4">Titik Lokasi PLTU</h2>

                <input wire:model.live.debounce.400ms="desa" placeholder="Cari desa..." class="w-full border p-2 mb-2">

                @if(!empty($desaResults))
                    <ul class="border mb-2 max-h-40 overflow-auto">
                        @foreach($desaResults as $i => $d)
                            <li wire:click="pilihDesa({{ $i }})" class="px-3 py-2 hover:bg-gray-100 cursor-pointer">
                                {{ $d['label'] }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <x-cms.pltu-map-edit />


                <div class="mt-4 border bg-gray-50 p-4 space-y-2 text-sm">
                    <div class="flex">
                        <div class="w-32 font-semibold">Pulau</div>
                        <div>: {{ $level_2 ?? '-' }}</div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-semibold">Provinsi</div>
                        <div>: {{ $level_3 ?? '-' }}</div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-semibold">Kab / Kota</div>
                        <div>: {{ $level_4 ?? '-' }}</div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-semibold">Kecamatan</div>
                        <div>: {{ $level_5 ?? '-' }}</div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-semibold">Desa</div>
                        <div>: {{ $level_6 ?? '-' }}</div>
                    </div>

                    <hr class="my-2">

                    <div class="flex">
                        <div class="w-32 font-semibold">Latitude</div>
                        <div>: {{ $latitude ?? '-' }}</div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-semibold">Longitude</div>
                        <div>: {{ $longitude ?? '-' }}</div>
                    </div>
                </div>
            @endif

            <div class="mt-6 flex gap-2">
                <a href="{{ route('cms.data.check-pltu.index', ['locale' => app()->getLocale()]) }}"
                    class="border px-6 py-2 bg-white hover:bg-black hover:text-white">
                    Batal
                </a>

                <button wire:click="update" class="bg-blue-600 text-white px-6 py-2">
                    Update Profil PLTU
                </button>
            </div>

        </main>
    </div>
</div>