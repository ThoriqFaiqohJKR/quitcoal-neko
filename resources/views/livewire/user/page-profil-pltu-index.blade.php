@php
  $isEn = app()->getLocale() === 'en';
  $namaPltu = $pltu->nama_pltu ?? '-';
  $heroImage = $pltu->image ?: 'https://images.unsplash.com/photo-1513828583688-c52646db42da?q=80&w=1800&auto=format&fit=crop';
  $overviewText = $isEn ? ($pltu->overview_en ?? null) : ($pltu->overview_id ?? null);
  $overviewPlain = \Illuminate\Support\Str::limit(trim(strip_tags($overviewText ?? '')), 220, '...');
  $corporateText = $isEn ? ($pltu->corporate_en ?? null) : ($pltu->corporate_id ?? null);
  $environmentText = $isEn ? ($pltu->environment_en ?? null) : ($pltu->environment_id ?? null);
  $spotlightText = $isEn ? ($pltu->spotlight_en ?? null) : ($pltu->spotlight_id ?? null);
@endphp

<div class="mx-auto w-full max-w-7xl">
  <section class="relative overflow-hidden bg-[#111827]">
    <img src="{{ $heroImage }}" class="absolute inset-0 h-full w-full object-cover opacity-30" alt="PLTU">
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/40"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-10 lg:py-28">
      <div class="max-w-4xl">
        <div class="text-sm uppercase tracking-[4px] text-white/60">Profil PLTU Indonesia</div>

        <h1 class="mt-5 text-4xl font-bold uppercase leading-tight text-white lg:text-6xl">
          {{ $namaPltu }}
        </h1>

        <p class="mt-6 max-w-3xl text-base leading-8 text-gray-300 lg:text-lg">{{ $overviewPlain ?: '-' }}</p>

        <div class="mt-8 flex flex-wrap gap-3">
          <div class="border border-white/20 bg-white/10 px-5 py-3 text-sm text-white backdrop-blur">
            Status: {{ $pltu->status ?? '-' }}
          </div>
          <div class="border border-white/20 bg-white/10 px-5 py-3 text-sm text-white backdrop-blur">
            Kapasitas: {{ $pltu->kapasitas ?? '-' }}
          </div>
          <div class="border border-white/20 bg-white/10 px-5 py-3 text-sm text-white backdrop-blur">
            Teknologi: {{ $pltu->teknologi_pembangkit ?? '-' }}
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mx-auto max-w-7xl px-6 py-10 lg:px-10">
    <div class="grid gap-6 lg:grid-cols-3">
      <div class="border border-gray-200 bg-white">
        <div class="border-b border-gray-200 px-6 py-5">
          <h2 class="text-lg font-bold uppercase tracking-[2px] text-[#007A63]">Informasi PLTU</h2>
        </div>

        <div class="divide-y divide-gray-200">
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Nama PLTU</div><div class="mt-2 text-sm font-medium text-gray-900">{{ $pltu->nama_pltu ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Unit</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->unit ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Status</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->status ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Kapasitas</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->kapasitas ?? '-' }}</div></div>
        </div>
      </div>

      <div class="border border-gray-200 bg-white">
        <div class="border-b border-gray-200 px-6 py-5">
          <h2 class="text-lg font-bold uppercase tracking-[2px] text-[#007A63]">Lokasi</h2>
        </div>

        <div class="divide-y divide-gray-200">
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Pulau</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->level_2 ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Provinsi</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->level_3 ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Kabupaten / Kota</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->level_4 ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Kecamatan</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->level_5 ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Desa</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->level_6 ?? '-' }}</div></div>
        </div>
      </div>

      <div class="border border-gray-200 bg-white">
        <div class="border-b border-gray-200 px-6 py-5">
          <h2 class="text-lg font-bold uppercase tracking-[2px] text-[#007A63]">Data Teknis</h2>
        </div>

        <div class="divide-y divide-gray-200">
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Teknologi</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->teknologi_pembangkit ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Coal Type</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->coal_type ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Coal Source</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->coal_source ?? '-' }}</div></div>
          <div class="px-6 py-4"><div class="text-xs uppercase tracking-[2px] text-gray-500">Konsumsi Batu Bara</div><div class="mt-2 text-sm text-gray-900">{{ $pltu->konsumsi_batubara_tahun ?? '-' }}</div></div>
        </div>
      </div>
    </div>

    <div class="mt-10 border border-gray-200 bg-white" x-data="{ tab: 'overview' }">
      <div class="border-b border-gray-200 px-6 py-5">
        <h2 class="text-xl font-bold uppercase tracking-[2px] text-[#007A63]">Detail PLTU</h2>
      </div>

      <div class="grid border-b border-gray-200 lg:grid-cols-4">
        <button @click="tab = 'overview'" :class="tab === 'overview' ? 'bg-[#007A63] text-white' : 'bg-white text-gray-500'" class="border-b border-gray-200 px-6 py-4 text-sm font-semibold uppercase tracking-[2px] lg:border-b-0 lg:border-r">Overview</button>
        <button @click="tab = 'corporate'" :class="tab === 'corporate' ? 'bg-[#007A63] text-white' : 'bg-white text-gray-500'" class="border-b border-gray-200 px-6 py-4 text-sm font-semibold uppercase tracking-[2px] lg:border-b-0 lg:border-r">Corporate</button>
        <button @click="tab = 'environment'" :class="tab === 'environment' ? 'bg-[#007A63] text-white' : 'bg-white text-gray-500'" class="border-b border-gray-200 px-6 py-4 text-sm font-semibold uppercase tracking-[2px] lg:border-b-0 lg:border-r">Environment</button>
        <button @click="tab = 'spotlight'" :class="tab === 'spotlight' ? 'bg-[#007A63] text-white' : 'bg-white text-gray-500'" class="px-6 py-4 text-sm font-semibold uppercase tracking-[2px]">Spotlight</button>
      </div>

      <div class="px-6 py-8">
        <div x-show="tab === 'overview'" class="prose max-w-none">{!! $overviewText ?: '-' !!}</div>
        <div x-show="tab === 'corporate'" class="prose max-w-none">{!! $corporateText ?: '-' !!}</div>
        <div x-show="tab === 'environment'" class="prose max-w-none">{!! $environmentText ?: '-' !!}</div>
        <div x-show="tab === 'spotlight'" class="prose max-w-none">{!! $spotlightText ?: '-' !!}</div>
      </div>
    </div>
  </section>
</div>
