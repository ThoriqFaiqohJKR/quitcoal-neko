<div class="mx-auto max-w-5xl">

    <div class="flex border-y max-h-5xl">

        {{-- SIDEBAR --}}
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
                    class="w-full text-left px-3 py-2
                                                        {{ $activeMenu === $key ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                    {{ $label }}
                </button>
            @endforeach
        </aside>

        {{-- CONTENT --}}
        <main class="w-3/4 p-6 overflow-auto">

            {{-- PROFIL --}}
            @if($activeMenu === 'profil')
                <h2 class="font-bold text-lg mb-4">Profil PLTU</h2>

                <input type="file" wire:model="image" class="w-full border p-2 mb-3">

                @if ($image)
                    <div class="aspect-square max-w-xs border mb-3 overflow-hidden">
                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <input wire:model="nama" class="w-full border p-2 mb-3" placeholder="Nama PLTU">
                <input wire:model="luas" class="w-full border p-2 mb-3" placeholder="Luas">
                <input wire:model="organisasi_id" class="w-full border p-2 mb-2" placeholder="Organisasi (ID)">
                <input wire:model="organisasi_en" class="w-full border p-2 mb-2" placeholder="Organisasi (EN)">
                <input wire:model="tipologi_id" class="w-full border p-2 mb-2" placeholder="Tipologi (ID)">
                <input wire:model="tipologi_en" class="w-full border p-2 mb-2" placeholder="Tipologi (EN)">
                <input wire:model="penggunaan_id" class="w-full border p-2 mb-2" placeholder="Penggunaan (ID)">
                <input wire:model="penggunaan_en" class="w-full border p-2 mb-2" placeholder="Penggunaan (EN)">
            @endif

            {{-- OVERVIEW --}}
            @if($activeMenu === 'overview')

                <h2 class="font-bold text-lg mb-2">Overview (ID)</h2>
                <x-tinymce id="overview_id_editor" wire:model="overview_id" />


                <h2 class="font-bold text-lg mt-6 mb-2">Overview (EN)</h2>
                <x-tinymce id="overview_en_editor" wire:model="overview_en" />

            @endif


            {{-- CORPORATE --}}
            @if($activeMenu === 'corporate')
                <h2 class="font-bold text-lg mb-4">Corporate</h2>
                <h2 class="font-bold text-lg mt-6 mb-2">Corporate (ID)</h2>
                <x-tinymce id="corporate_id_editor" wire:model="corporate_id" />
                <h2 class="font-bold text-lg mt-6 mb-2">Corporate (EN)</h2>
                <x-tinymce id="corporate_en_editor" wire:model="corporate_en" />
            @endif

            {{-- ENVIRONMENT --}}
            @if($activeMenu === 'environment')
                <h2 class="font-bold text-lg mb-4">Environment</h2>
                <h2 class="font-bold text-lg mt-6 mb-2">Environment (ID)</h2>
                <x-tinymce id="environment_id_editor" wire:model="environment_id" />
                <h2 class="font-bold text-lg mt-6 mb-2">Environment (EN)</h2>
                <x-tinymce id="environment_en_editor" wire:model="environment_en" />
            @endif

            {{-- SPOTLIGHT --}}
            @if($activeMenu === 'spotlight')
                <h2 class="font-bold text-lg mb-4">Spotlight</h2>
                <h2 class="font-bold text-lg mt-6 mb-2">Spotlight (ID)</h2>
                <x-tinymce id="spotlight_id_editor" wire:model="spotlight_id" />
                <h2 class="font-bold text-lg mt-6 mb-2">Spotlight (ID)</h2>
                <x-tinymce id="spotlight_en_editor" wire:model="spotlight_en" />
            @endif

            {{-- LOKASI --}}
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

                {{-- MAP --}}
                <x-pltu-map />

                <div class="mt-4 border rounded bg-gray-50 p-4 space-y-2 text-sm">

                    <div class="flex">
                        <div class="w-32 font-semibold">Provinsi</div>
                        <div>: {{ $level_2 ?? '-' }}</div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-semibold">Kab / Kota</div>
                        <div>: {{ $level_3 ?? '-' }}</div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-semibold">Kecamatan</div>
                        <div>: {{ $level_4 ?? '-' }}</div>
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

            <div class="mt-6">
                <button wire:click="save" class="bg-blue-600 text-white px-6 py-2">
                    Simpan Profil PLTU
                </button>
            </div>

        </main>
    </div>
</div>