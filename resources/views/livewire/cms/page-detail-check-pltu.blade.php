<div class="max-w-5xl mx-auto py-12">

    <div class="mb-4 text-xl text-gray-600 flex items-center gap-2">
        <a href="{{ route('cms.data.check-pltu.index') }}">
            CHECK PLTU
        </a>

        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>

        <p class="font-semibold text-gray-900">Detail PLTU</p>
    </div>

    <div class="border bg-white mb-6">

        <div class="px-4 py-2 border-b font-semibold flex items-center justify-between">
            <div>Profil PLTU</div>

            <a href="{{ route('cms.data.check-pltu.edit', $pltu->id) }}" class="px-3 py-1 border text-sm text-white bg-black hover:text-black hover:bg-white">
                Edit
            </a>
        </div>

        <div class="p-4 flex justify-center">
            @if(!empty($pltu->image))
                <div class="w-40 h-40 border overflow-hidden">
                    <img src="{{ asset('storage/' . $pltu->image) }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-40 h-40 border flex items-center justify-center text-xs text-gray-500">
                    Tidak ada gambar
                </div>
            @endif
        </div>

        <div class="px-4 pb-4 grid grid-cols-2 gap-x-6 gap-y-3 text-sm">

            <div>ID PLTU</div>
            <div>{{ $pltu->id ?? '-' }}</div>

            <div>Nama PLTU</div>
            <div>{{ $pltu->nama_pltu ?? '-' }}</div>

            <div>Unit</div>
            <div>{{ $pltu->unit ?? '-' }}</div>

            <div>Status</div>
            <div>{{ $pltu->status ?? '-' }}</div>

            <div>Kapasitas</div>
            <div>{{ $pltu->kapasitas ?? '-' }}</div>

            <div>Teknologi Pembangkit</div>
            <div>{{ $pltu->teknologi_pembangkit ?? '-' }}</div>

            <div>Konsumsi Batubara / Tahun</div>
            <div>{{ $pltu->konsumsi_batubara_tahun ?? '-' }}</div>

            <div>Tahun Pembangunan</div>
            <div>{{ $pltu->tahun_pembangunan ?? '-' }}</div>

            <div>Mulai Beroperasi</div>
            <div>{{ $pltu->beroperasi ?? '-' }}</div>

            <div>Tahun Berakhir</div>
            <div>{{ $pltu->berakhir ?? '-' }}</div>

            <div>Nilai Investasi</div>
            <div>{{ $pltu->mata_uang_nilai_investasi ?? '-' }} {{ $pltu->nilai_investasi ?? '' }}</div>

            <div>Program Pemerintah</div>
            <div>{{ $pltu->program_pemerintah ?? '-' }}</div>

            <div>Lembaga Pemberi Pinjaman</div>
            <div>{{ $pltu->lembaga_pemberi_pinjaman ?? '-' }}</div>

            <div>Pinjaman</div>
            <div>{{ $pltu->pinjaman ?? '-' }}</div>

            <div>Nilai Pinjaman</div>
            <div>{{ $pltu->mata_uang_nilai_pinjaman ?? '-' }} {{ $pltu->nilai_pinjaman ?? '' }}</div>

            <div>Pengelolaan 1</div>
            <div>{{ $pltu->pengelolaan_1 ?? '-' }}</div>

            <div>Pengelolaan 2</div>
            <div>{{ $pltu->pengelolaan_2 ?? '-' }}</div>

            <div>Pengelola</div>
            <div>{{ $pltu->pengelola ?? '-' }}</div>

            <div>Kontraktor Konstruksi</div>
            <div>{{ $pltu->kontraktor_konstruksi ?? '-' }}</div>

            <div>Combustion Technology</div>
            <div>{{ $pltu->combustion_technology ?? '-' }}</div>

            <div>Coal Type</div>
            <div>{{ $pltu->coal_type ?? '-' }}</div>

            <div>Coal Source</div>
            <div>{{ $pltu->coal_source ?? '-' }}</div>

            <div>Alternate Fuel</div>
            <div>{{ $pltu->alternate_fuel ?? '-' }}</div>

            <div>Captive</div>
            <div>{{ $pltu->captive ?? '-' }}</div>

            <div>Captive Industry Use</div>
            <div>{{ $pltu->captive_industry_use ?? '-' }}</div>

            <div>Captive Residential Use</div>
            <div>{{ $pltu->captive_residential_use ?? '-' }}</div>

            <div>Plant Age (Years)</div>
            <div>{{ $pltu->plant_age_years ?? '-' }}</div>

            <div>Reference</div>
            <div>{{ $pltu->reference ?? '-' }}</div>

        </div>

        <div class="px-4 pb-4 grid grid-cols-2 gap-x-6 gap-y-3 text-sm">
            <div>Pulau</div>
            <div>{{ $pltu->level_2 ?? '-' }}</div>

            <div>Provinsi</div>
            <div>{{ $pltu->level_3 ?? '-' }}</div>

            <div>Kota / Kabupaten</div>
            <div>{{ $pltu->level_4 ?? '-' }}</div>

            <div>Kecamatan</div>
            <div>{{ $pltu->level_5 ?? '-' }}</div>

            <div>Desa</div>
            <div>{{ $pltu->level_6 ?? '-' }}</div>

            <div>Koordinat</div>
            <div>{{ $pltu->latitude ?? '-' }}, {{ $pltu->longitude ?? '-' }}</div>
        </div>

        <div class="px-4 pb-4">
            <div class="w-full h-72 border flex items-center justify-center text-sm text-gray-500">
                Peta lokasi PLTU (dummy)
            </div>
        </div>

    </div>

    <div class="border bg-white" x-data="{ tab: 'overview' }">

        <div class="px-4 py-2 border-b font-semibold">
            <div>Detail PLTU</div>
        </div>

        <div class="px-4 pt-4">
            <div class="flex text-sm border">
                <button class="w-1/4 py-2 border-r" @click="tab='overview'"
                    :class="tab==='overview' ? 'bg-green-600 text-white' : 'bg-gray-100'">
                    Overview
                </button>
                <button class="w-1/4 py-2 border-r" @click="tab='corporate'"
                    :class="tab==='corporate' ? 'bg-green-600 text-white' : 'bg-gray-100'">
                    Corporate
                </button>
                <button class="w-1/4 py-2 border-r" @click="tab='environment'"
                    :class="tab==='environment' ? 'bg-green-600 text-white' : 'bg-gray-100'">
                    Environment
                </button>
                <button class="w-1/4 py-2" @click="tab='spotlight'"
                    :class="tab==='spotlight' ? 'bg-green-600 text-white' : 'bg-gray-100'">
                    Spotlight
                </button>
            </div>
        </div>

        <div class="p-4 text-sm">
            <div x-show="tab==='overview'">{!! $pltu->overview_id ?? '-' !!}</div>
            <div x-show="tab==='corporate'">{!! $pltu->corporate_id ?? '-' !!}</div>
            <div x-show="tab==='environment'">{!! $pltu->environment_id ?? '-' !!}</div>
            <div x-show="tab==='spotlight'">{!! $pltu->spotlight_id ?? '-' !!}</div>
        </div>

    </div>

</div>
