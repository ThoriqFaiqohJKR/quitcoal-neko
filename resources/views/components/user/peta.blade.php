@verbatim
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <div wire:ignore class="relative z-0" style="width:100%; height:500px;" x-data='{
        map: null,
        layerLevel1: null,
        markerLayer: null,
        bounds: null,
        baseZoom: null,
        level1Removed: false,

        initMap() {
            if (this.map) return;

            this.bounds = L.latLngBounds(
                [-11, 95],
                [6.5, 141]
            );

            
            this.mapBounds = this.bounds.pad(0.0);

            this.map = L.map(this.$el, {
                zoomControl: true,
                minZoom: 4,
                maxZoom: 20,
                maxBounds: this.mapBounds,
                maxBoundsViscosity: 1.0,
                bounceAtZoomLimits: false,
                zoomSnap: 0.1,
                zoomDelta: 0.1
            });

            this.map.setView([-2.5, 118], 4.8);

            this.baseZoom = this.map.getZoom();
            

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 20
            }).addTo(this.map);

            this.layerLevel1 = L.tileLayer.wms(
                "https://aws.simontini.id/geoserver/proteus/wms",
                {
                    layers: "proteus:POLITICAL_LEVEL_1_dissolved",
                    format: "image/png",
                    transparent: true,
                    version: "1.3.0"
                }
            ).addTo(this.map);

            
            fetch("/geojson-indonesia")
                .then(res => res.json())
                .then(geojson => {
                    this.indonesiaLayer = L.geoJSON(geojson, {
                        style: {
                            color: "#ff0000",
                            weight: 1,
                            fillOpacity: 0.05
                        }
                    }).addTo(this.map);
                })
                .catch(err => console.log("gagal load polygon indonesia", err));

            this.loadMarker();

            this.map.on("zoomend", () => {
                const z = this.map.getZoom();

                if (z > this.baseZoom && !this.level1Removed) {
                    if (this.map.hasLayer(this.layerLevel1)) {
                        this.map.removeLayer(this.layerLevel1);
                    }

                    this.level1Removed = true;
                }

                if (z <= this.baseZoom && this.level1Removed) {
                    if (!this.map.hasLayer(this.layerLevel1)) {
                        this.map.addLayer(this.layerLevel1);
                    }

                    this.level1Removed = false;
                }
                
                
            });

            this.map.invalidateSize();
        },

        async loadMarker() {
            const pinIcon = L.icon({
                iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
                shadowUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            try {
                const res = await fetch("/get-data");
                const geojson = await res.json();

                if (this.markerLayer) {
                    this.map.removeLayer(this.markerLayer);
                }

                this.markerLayer = L.markerClusterGroup({
                    spiderfyOnMaxZoom: true,
                    showCoverageOnHover: false,
                    zoomToBoundsOnClick: true,
                    disableClusteringAtZoom: 12
                });

                const geoLayer = L.geoJSON(geojson, {
                    pointToLayer: (feature, latlng) => {
                        return L.marker(latlng, { icon: pinIcon });
                    },

                    onEachFeature: (feature, layer) => {
                        const p = feature.properties || {};

                        const html = [
                            "<div style=\"font-size:12px; line-height:1.4;\">",
                            "<div style=\"font-weight:bold; font-size:14px; margin-bottom:6px;\">" + (p.nama ?? "-") + "</div>",
                            "<hr style=\"margin:6px 0;\">",
                            "<div><b>Luas:</b> " + (p.luas ?? "-") + "</div>",
                            "<div><b>Pulau:</b> " + (p.level_2 ?? "-") + "</div>",
                            "<div><b>Provinsi:</b> " + (p.level_3 ?? "-") + "</div>",
                            "<div><b>Kecamatan:</b> " + (p.level_4 ?? "-") + "</div>",
                            "<div><b>Desa:</b> " + (p.level_5 ?? "-") + "</div>",
                            "<div style=\"margin-top:10px;\">" +
                                "<a href=\"https://google.com\" target=\"_blank\" rel=\"noopener noreferrer\" " +
                                "style=\"display:inline-block; padding:6px 10px; background:#2563eb; color:white; text-decoration:none;\">" +
                                "Informasi lebih lanjut</a>" +
                            "</div>",
                            "</div>"
                        ].join("");

                        layer.bindPopup(html);
                    }
                });

                this.markerLayer.addLayer(geoLayer);
                this.map.addLayer(this.markerLayer);

            } catch (e) {
                console.log("gagal load marker");
            }
        }
    }' x-init="initMap()"></div>
@endverbatim
