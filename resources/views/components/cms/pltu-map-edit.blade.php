<div wire:ignore style="width:100%; height:400px;"
x-data="{
    map: null,
    marker: null,
    desaLayer: null,
    canPickPoint: false,
    selectedDesa: null,

    initMap() {
        if (this.map) return;

        this.map = L.map(this.$el, {
            minZoom: 5,
            maxZoom: 22
        });

        this.map.fitBounds([
            [-11, 95],
            [6.5, 141]
        ]);

        // base map OSM
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 22
        }).addTo(this.map);

        // klik map untuk set titik
        this.map.on('click', (e) => {
            if (!this.canPickPoint) return;
            if (!this.desaLayer) return;

            let inside = false;

            this.desaLayer.eachLayer(layer => {
                if (layer.getBounds && layer.getBounds().contains(e.latlng)) {
                    inside = true;
                }
            });

            if (!inside) {
                alert('Titik harus di dalam polygon desa!');
                return;
            }

            if (this.marker) {
                this.marker.setLatLng(e.latlng);
            } else {
                this.marker = L.marker(e.latlng).addTo(this.map);
            }

            Livewire.dispatch('setPltuPoint', {
                latitude: e.latlng.lat,
                longitude: e.latlng.lng
            });
        });

        setTimeout(() => {
            this.map.invalidateSize();
        }, 50);
    },

    setMarker(lat, lng) {
        if (!lat || !lng) return;

        if (this.marker) {
            this.marker.setLatLng([lat, lng]);
        } else {
            this.marker = L.marker([lat, lng]).addTo(this.map);
        }

        this.map.setView([lat, lng], 15);
    },

    async showDesa(level_6) {
        if (!level_6) return;

        this.selectedDesa = level_6;

        // hapus polygon lama
        if (this.desaLayer) {
            this.map.removeLayer(this.desaLayer);
            this.desaLayer = null;
        }

        // ambil polygon desa pakai WFS (GeoJSON)
        let url =
            `https://aws.simontini.id/geoserver/proteus/ows?` +
            `service=WFS&version=1.0.0&request=GetFeature&` +
            `typeName=proteus:POLITICAL_LEVEL_6_dissolved&` +
            `outputFormat=application/json&` +
            `CQL_FILTER=LEVEL_6='${level_6}'`;

        try {
            let res = await fetch(url);
            let geojson = await res.json();

            if (!geojson.features || geojson.features.length == 0) {
                alert('Polygon desa tidak ditemukan!');
                return;
            }

            this.desaLayer = L.geoJSON(geojson, {
                style: {
                    color: '#2563eb',
                    weight: 3,
                    fillColor: '#3b82f6',
                    fillOpacity: 0.25
                }
            }).addTo(this.map);

            this.map.fitBounds(this.desaLayer.getBounds(), { padding: [30, 30] });

            this.canPickPoint = true;

        } catch (err) {
            console.log(err);
            alert('Gagal load polygon desa!');
        }
    }
}"
x-init="
    initMap();

    window.addEventListener('init-pltu-map', () => {
        setTimeout(() => {
            map.invalidateSize();
        }, 50);
    });

    window.addEventListener('set-marker', e => {
        setMarker(e.detail.latitude, e.detail.longitude);
    });

    window.addEventListener('show-desa-wms', e => {
        showDesa(e.detail.level_6);
    });
"
></div>
 