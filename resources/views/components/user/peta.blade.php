@verbatim
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <div wire:ignore class="relative z-0" style="width:100%; height:500px;" x-data='{
            map: null,
            markerLayer: null,
            bounds: null,
            baseZoom: null,
            jenisPltu: "",

            initMap() {
                if (this.map) return;

                this.bounds = L.latLngBounds(
                    [-11, 95],
                    [6.5, 141]
                );


                this.mapBounds = this.bounds.pad(0.0);

                this.map = L.map(this.$el, {
                    zoomControl: true,
                    attributionControl: false,
                    minZoom: 4,
                    maxZoom: 20,
                    maxBounds: this.mapBounds,
                    maxBoundsViscosity: 1.0,
                    bounceAtZoomLimits: false,
                    zoomSnap: 0.1,
                    zoomDelta: 0.1
                });



                this.map.setView([-2.5, 118], 4.9);

                this.baseZoom = this.map.getZoom();
                this.map.setMinZoom(this.baseZoom);


                L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
                    maxZoom: 20
                })
                .addTo(this.map);

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

                window.addEventListener("filter-jenis-pltu", (event) => {
                    this.jenisPltu = event.detail || "";
                    this.loadMarker();
                });
                this.map.invalidateSize();
            },

            async loadMarker() {
                try {
                    const params = new URLSearchParams();
                    if (this.jenisPltu) {
                        params.set("jenis_pltu", this.jenisPltu);
                    }

                    const url = params.toString() ? "/get-data?" + params.toString() : "/get-data";
                    const res = await fetch(url);
                    if (!res.ok) {
                        console.log("response error", res.status);
                        return;
                    }
                    const geojson = await res.json();
                    console.log("jumlah feature:", geojson.features ? geojson.features.length : 0);

                    if (this.markerLayer) {
                        this.map.removeLayer(this.markerLayer);
                    }

                    if (geojson.features && geojson.features.length === 1) {
                        this.markerLayer = L.layerGroup();
                    } else {
                        this.markerLayer = L.markerClusterGroup({
                            spiderfyOnMaxZoom: false,
                            showCoverageOnHover: false,
                            zoomToBoundsOnClick: true,
                            disableClusteringAtZoom: 14
                        });
                    }

                    const geoLayer = L.geoJSON(geojson, {

                        pointToLayer: (feature, latlng) => {
                            const jenis = feature.properties ? feature.properties.jenis_pltu : null;
                            const color = jenis === "captive" ? "#dc2626" : jenis === "non captive" ? "#2563eb" : "#111827";
                            const icon = L.divIcon({
                                className: "",
                                html: "<div style=\"width:18px;height:18px;border-radius:999px;background:" + color + ";border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,.35);\"></div>",
                                iconSize: [18, 18],
                                iconAnchor: [9, 9],
                                popupAnchor: [0, -9]
                            });

                            return L.marker(latlng, { icon: icon });
                        },

                        onEachFeature: (feature, layer) => {
                            const p = feature.properties || {};
                            const locale = window.location.pathname.split("/").filter(Boolean)[0] || "id";
                            const detailUrl = "/" + locale + "/data/profil-pltu?id=" + (p.id ?? "");

                            const html = [
                                "<div style=\"font-size:12px; line-height:1.4;\">",
                                "<div style=\"font-weight:bold; font-size:14px; margin-bottom:6px;\">" + (p.nama ?? "-") + "</div>",
                                "<hr style=\"margin:6px 0;\">",
                                "<div><b>Jenis PLTU:</b> " + (p.jenis_pltu ?? "-") + "</div>",
                                "<div><b>Luas:</b> " + (p.luas ?? "-") + "</div>",
                                "<div><b>Pulau:</b> " + (p.level_2 ?? "-") + "</div>",
                                "<div><b>Provinsi:</b> " + (p.level_3 ?? "-") + "</div>",
                                "<div><b>Kabupaten/Kota:</b> " + (p.level_4 ?? "-") + "</div>",
                                "<div><b>Kecamatan:</b> " + (p.level_5 ?? "-") + "</div>",
                                "<div style=\"margin-top:10px;\">" +
                                    "<a href=\"" + detailUrl + "\" " +
                                    "style=\"display:inline-block; padding:6px 10px; background:#2563eb; color:white; text-decoration:none;\">" +
                                    "Informasi lebih lanjut</a>" +
                                "</div>",
                                "</div>"
                            ].join("");

                            layer.bindPopup(html);

                            const mapInstance = this.map;
                            layer.on("click", function (e) {
                                mapInstance.flyTo(e.latlng, 13, {
                                    duration: 0.8
                                });
                            });
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
