@props([
    'id',
    'bounds' => null,
])

<div wire:ignore id="{{ $id }}" class="h-[600px] w-full"></div>

@once
@push('scripts')
<script>
window.LeafletMap = window.LeafletMap || {};

document.addEventListener('DOMContentLoaded', () => {

    const map = L.map('{{ $id }}');

    @if($bounds)
        map.fitBounds(@json($bounds));
    @else
        map.setView([-2.5, 118.0], 5);
    @endif

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    window.LeafletMap['{{ $id }}'] = map;

    Livewire.on('map-center', (data) => {
        map.setView([data.lat, data.lng], data.zoom);
    });

});
</script>
@endpush
@endonce
