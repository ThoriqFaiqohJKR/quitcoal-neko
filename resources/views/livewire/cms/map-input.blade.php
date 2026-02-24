<div>

    <input wire:model.live.debounce.200ms="desa" placeholder="Cari desa..." class="w-full p-2 border rounded mb-1" />

    @if(!empty($desaResults))
        <ul class="border bg-white rounded mb-4 max-h-64 overflow-y-auto">
            @foreach($desaResults as $i => $des)
                <li wire:click="pilihDesa({{ $i }})" class="cursor-pointer px-3 py-2 hover:bg-gray-100">
                    {{ $des['name_full'] }}
                </li>
            @endforeach
        </ul>
    @endif


    @if($desaSelected)
        <div class="p-3 mb-3 bg-gray-50 border rounded">
            <div><b>Desa:</b> {{ $desaSelected['desa'] }}</div>
            <div><b>Kecamatan:</b> {{ $desaSelected['kecamatan'] }}</div>

            <div class="mt-2">
                <b>Titik PLTU:</b>
                @if($pltu_lat && $pltu_lon)
                    {{ $pltu_lat }}, {{ $pltu_lon }}
                @else
                    <span class="text-red-600">Belum dipilih</span>
                @endif
            </div>

            <button wire:click="save" @disabled(!$pltu_lat || !$pltu_lon)
                class="mt-3 px-4 py-2 bg-green-600 text-white rounded disabled:opacity-50">
                Simpan
            </button>
        </div>
    @endif

    <div wire:ignore class="mt-4">
        <div id="map" style="height:400px;"></div>
    </div>

    @if (session()->has('success'))
        <div class="mt-3 p-2 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

</div>

@push('scripts')
    <script src="https://unpkg.com/leaflet-pip@1.1.0/leaflet-pip.min.js"></script>

    <script>
        let map;
        let desaPolygon = null;
        let pltuMarker = null;
        let lastValidLatLng = null;

        document.addEventListener('livewire:init', () => {

            map = L.map('map').setView([-6.2, 106.8], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            Livewire.on('zoom-map', data => {
                if (!data.geometry) return;

                if (desaPolygon) map.removeLayer(desaPolygon);
                if (pltuMarker) map.removeLayer(pltuMarker);

                desaPolygon = L.geoJSON(data.geometry, {
                    style: {
                        color: '#2563eb',
                        weight: 2,
                        fillOpacity: 0.35
                    }
                }).addTo(map);

                map.fitBounds(desaPolygon.getBounds());

                map.off('click');
                map.on('click', e => {
                    const latlng = e.latlng;

                    const inside = leafletPip.pointInLayer(
                        [latlng.lng, latlng.lat],
                        desaPolygon
                    );

                    if (inside.length === 0) {
                        alert('Titik harus di dalam desa');
                        return;
                    }

                    if (pltuMarker) map.removeLayer(pltuMarker);

                    pltuMarker = L.marker(latlng, { draggable: true }).addTo(map);
                    lastValidLatLng = latlng;

                    @this.call('setPltuPoint', {
                        latitude: latlng.lat,
                        longitude: latlng.lng
                    });

                    pltuMarker.on('dragend', ev => {
                        const pos = ev.target.getLatLng();

                        const valid = leafletPip.pointInLayer(
                            [pos.lng, pos.lat],
                            desaPolygon
                        );

                        if (valid.length === 0) {
                            ev.target.setLatLng(lastValidLatLng);
                            return;
                        }

                        lastValidLatLng = pos;

                        @this.call('setPltuPoint', {
                            latitude: pos.lat,
                            longitude: pos.lng
                        });
                    });
                });
            });

        });
    </script>

@endpush