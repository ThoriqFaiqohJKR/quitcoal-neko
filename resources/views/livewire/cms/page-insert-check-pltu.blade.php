<div class="mx-auto max-w-5xl py-12">
    <div class="flex border-y max-h-5xl">

        <aside class="w-1/4 border-r bg-gray-50 p-4 space-y-2">

            <button wire:click="$set('activeMenu','profil')"
                class="w-full text-left px-3 py-2 {{ $activeMenu === 'profil' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                Profil PLTU
            </button>

            <button wire:click="$set('activeMenu','overview')"
                class="w-full text-left px-3 py-2 {{ $activeMenu === 'overview' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                Overview
            </button>

            <button wire:click="$set('activeMenu','corporate')"
                class="w-full text-left px-3 py-2 {{ $activeMenu === 'corporate' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                Corporate
            </button>

            <button wire:click="$set('activeMenu','environment')"
                class="w-full text-left px-3 py-2 {{ $activeMenu === 'environment' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                Environment
            </button>

            <button wire:click="$set('activeMenu','spotlight')"
                class="w-full text-left px-3 py-2 {{ $activeMenu === 'spotlight' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                Spotlight
            </button>

            <button wire:click="setMenuLokasi"
                class="w-full text-left px-3 py-2 {{ $activeMenu === 'lokasi' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                Titik Lokasi
            </button>


        </aside>

        <main class="w-3/4 p-6 overflow-auto">

            <div class="{{ $activeMenu === 'profil' ? '' : 'hidden' }}">
                <h2 class="font-bold text-lg mb-4">Profil PLTU</h2>

                <input type="file" wire:model="image" class="w-full border p-2 mb-3">

                @if ($image)
                    <div class="aspect-square max-w-xs border mb-3 overflow-hidden">
                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <input wire:model.defer="nama_pltu" class="w-full border p-2 mb-3" placeholder="Nama PLTU">
                <input wire:model.defer="unit" class="w-full border p-2 mb-3" placeholder="Unit">

                <input wire:model.defer="teknologi_pembangkit" class="w-full border p-2 mb-3"
                    placeholder="Teknologi Pembangkit">
                <input wire:model.defer="status" class="w-full border p-2 mb-3" placeholder="Status">

                <input step="0.01" wire:model.defer="kapasitas" class="w-full border p-2 mb-3"
                    placeholder="Kapasitas (MW)">
                <input wire:model.defer="konsumsi_batubara_tahun" class="w-full border p-2 mb-3"
                    placeholder="Konsumsi Batubara / Tahun">

                <input wire:model.defer="tahun_pembangunan" class="w-full border p-2 mb-3"
                    placeholder="Tahun Pembangunan">
                <input wire:model.defer="beroperasi" class="w-full border p-2 mb-3" placeholder="Beroperasi (Tahun)">
                <input wire:model.defer="berakhir" class="w-full border p-2 mb-3" placeholder="Berakhir (Tahun)">

                <input wire:model.defer="mata_uang_nilai_investasi" class="w-full border p-2 mb-3"
                    placeholder="Mata Uang Nilai Investasi">
                <input step="0.01" wire:model.defer="nilai_investasi" class="w-full border p-2 mb-3"
                    placeholder="Nilai Investasi">

                <input wire:model.defer="program_pemerintah" class="w-full border p-2 mb-3"
                    placeholder="Program Pemerintah">

                <input wire:model.defer="lembaga_pemberi_pinjaman" class="w-full border p-2 mb-3"
                    placeholder="Lembaga Pemberi Pinjaman">
                <input wire:model.defer="pinjaman" class="w-full border p-2 mb-3" placeholder="Pinjaman">

                <input wire:model.defer="mata_uang_nilai_pinjaman" class="w-full border p-2 mb-3"
                    placeholder="Mata Uang Nilai Pinjaman">
                <input step="0.01" wire:model.defer="nilai_pinjaman" class="w-full border p-2 mb-3"
                    placeholder="Nilai Pinjaman">

                <input wire:model.defer="pengelolaan_1" class="w-full border p-2 mb-3" placeholder="Pengelolaan 1">
                <input wire:model.defer="pengelolaan_2" class="w-full border p-2 mb-3" placeholder="Pengelolaan 2">

                <input wire:model.defer="pengelola" class="w-full border p-2 mb-3" placeholder="Pengelola">
                <input wire:model.defer="kontraktor_konstruksi" class="w-full border p-2 mb-3"
                    placeholder="Kontraktor Konstruksi">

                <input wire:model.defer="combustion_technology" class="w-full border p-2 mb-3"
                    placeholder="Combustion Technology">
                <input wire:model.defer="coal_type" class="w-full border p-2 mb-3" placeholder="Coal Type">
                <input wire:model.defer="coal_source" class="w-full border p-2 mb-3" placeholder="Coal Source">
                <input wire:model.defer="alternate_fuel" class="w-full border p-2 mb-3" placeholder="Alternate Fuel">

                <input wire:model.defer="captive" class="w-full border p-2 mb-3" placeholder="Captive">
                <input wire:model.defer="captive_industry_use" class="w-full border p-2 mb-3"
                    placeholder="Captive Industry Use">
                <input wire:model.defer="captive_residential_use" class="w-full border p-2 mb-3"
                    placeholder="Captive Residential Use">

                <input wire:model.defer="plant_age_years" class="w-full border p-2 mb-3"
                    placeholder="Plant Age (Years)">
                <textarea wire:model.defer="reference" class="w-full border p-2 mb-3"
                    placeholder="Reference"></textarea>
            </div>

            <div class="{{ $activeMenu === 'overview' ? '' : 'hidden' }}">
                <h2 class="font-bold text-lg mb-2">Overview (ID)</h2>
                <div wire:ignore>
                    <x-tinymce id="overview_id_editor" model="overview_id" />
                </div>

                <h2 class="font-bold text-lg mt-6 mb-2">Overview (EN)</h2>
                <div wire:ignore>
                    <x-tinymce id="overview_en_editor" model="overview_en" />
                </div>
            </div>

            <div class="{{ $activeMenu === 'corporate' ? '' : 'hidden' }}">
                <h2 class="font-bold text-lg mt-6 mb-2">Corporate (ID)</h2>
                <div wire:ignore>
                    <x-tinymce id="corporate_id_editor" model="corporate_id" />
                </div>

                <h2 class="font-bold text-lg mt-6 mb-2">Corporate (EN)</h2>
                <div wire:ignore>
                    <x-tinymce id="corporate_en_editor" model="corporate_en" />
                </div>
            </div>

            <div class="{{ $activeMenu === 'environment' ? '' : 'hidden' }}">
                <h2 class="font-bold text-lg mt-6 mb-2">Environment (ID)</h2>
                <div wire:ignore>
                    <x-tinymce id="environment_id_editor" model="environment_id" />
                </div>

                <h2 class="font-bold text-lg mt-6 mb-2">Environment (EN)</h2>
                <div wire:ignore>
                    <x-tinymce id="environment_en_editor" model="environment_en" />
                </div>
            </div>

            <div class="{{ $activeMenu === 'spotlight' ? '' : 'hidden' }}">
                <h2 class="font-bold text-lg mt-6 mb-2">Spotlight (ID)</h2>
                <div wire:ignore>
                    <x-tinymce id="spotlight_id_editor" model="spotlight_id" />
                </div>

                <h2 class="font-bold text-lg mt-6 mb-2">Spotlight (EN)</h2>
                <div wire:ignore>
                    <x-tinymce id="spotlight_en_editor" model="spotlight_en" />
                </div>
            </div>

            <div class="{{ $activeMenu === 'lokasi' ? '' : 'hidden' }}">
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

                <x-cms.pltu-map-insert />

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
            </div>

            <div class="mt-6">
                <button wire:click="save" class="bg-blue-600 text-white px-6 py-2">
                    Simpan Profil PLTU
                </button>
            </div>

        </main>
    </div>
</div>