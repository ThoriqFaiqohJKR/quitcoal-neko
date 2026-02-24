<div wire:ignore>
    <div id="map-pltu" style="width:100%; height:400px;" class="border"
        x-data="{
            initMap() {
                if (window.pltuMap) return;

                window.pltuMap = L.map('map-pltu', {
                    minZoom: 4,
                    maxZoom: 22,
                    maxBounds: [
                        [-11, 95],
                        [6.5, 141]
                    ],
                    maxBoundsViscosity: 1.0
                });

                window.pltuMap.fitBounds([
                    [-11, 95],
                    [6.5, 141]
                ]);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 22
                }).addTo(window.pltuMap);

                L.tileLayer.wms('https://aws.simontini.id/geoserver/proteus/wms', {
                    layers: 'proteus:POLITICAL_LEVEL_1_dissolved',
                    format: 'image/png',
                    transparent: true
                }).addTo(window.pltuMap);

                window.desaLayer = null;
                window.pltuMarker = null;
                window.selectedGeometry = null;

                const pointInRing = (pt, ring) => {
                    let x = pt.lng, y = pt.lat;
                    let inside = false;

                    for (let i = 0, j = ring.length - 1; i < ring.length; j = i++) {
                        let xi = ring[i].lng, yi = ring[i].lat;
                        let xj = ring[j].lng, yj = ring[j].lat;

                        let intersect =
                            ((yi > y) !== (yj > y)) &&
                            (x < (xj - xi) * (y - yi) / (yj - yi) + xi);

                        if (intersect) inside = !inside;
                    }

                    return inside;
                };

                const isPointInsidePolygon = (pt, latlngs) => {
                    if (!Array.isArray(latlngs)) return false;

                    if (Array.isArray(latlngs[0]) && Array.isArray(latlngs[0][0])) {
                        for (let poly of latlngs) {
                            if (pointInRing(pt, poly[0])) return true;
                        }
                        return false;
                    }

                    return pointInRing(pt, latlngs[0] ?? latlngs);
                };

                window.pltuMap.on('click', e => {
                    if (!window.selectedGeometry || !window.desaLayer) return;

                    let allowed = false;

                    window.desaLayer.eachLayer(layer => {
                        if (layer instanceof L.Polygon) {
                            let latlngs = layer.getLatLngs();
                            if (isPointInsidePolygon(e.latlng, latlngs)) {
                                allowed = true;
                            }
                        }
                    });

                    if (!allowed) return;

                    if (window.pltuMarker) window.pltuMap.removeLayer(window.pltuMarker);

                    window.pltuMarker = L.marker(e.latlng).addTo(window.pltuMap);

                    Livewire.dispatch('setPltuPoint', {
                        latitude: e.latlng.lat,
                        longitude: e.latlng.lng
                    });
                });

                window.addEventListener('zoom-map', e => {
                    window.selectedGeometry = e.detail.geometry;

                    if (window.desaLayer) window.pltuMap.removeLayer(window.desaLayer);

                    window.desaLayer = L.geoJSON(window.selectedGeometry, {
                        style: {
                            color: '#2563eb',
                            weight: 2,
                            fillColor: '#60a5fa',
                            fillOpacity: 0.35
                        }
                    }).addTo(window.pltuMap);

                    window.pltuMap.fitBounds(window.desaLayer.getBounds(), {
                        padding: [30, 30]
                    });

                    setTimeout(() => {
                        window.pltuMap.invalidateSize();
                    }, 200);
                });

                window.addEventListener('refresh-map', () => {
                    setTimeout(() => {
                        window.pltuMap.invalidateSize();

                        if (window.desaLayer) {
                            window.pltuMap.fitBounds(window.desaLayer.getBounds(), {
                                padding: [30, 30]
                            });
                        }

                        if (window.pltuMarker) {
                            window.pltuMap.panTo(window.pltuMarker.getLatLng());
                        }
                    }, 200);
                });

                setTimeout(() => {
                    window.pltuMap.invalidateSize();
                }, 200);
            }
        }"
        x-init="initMap()">
    </div>
</div>
