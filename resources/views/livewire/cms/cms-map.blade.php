<div class="grid grid-cols-12 gap-4">

    <div class="col-span-9 bg-white rounded shadow">
        <x-map.leaflet
            id="mainMap"
            :bounds="[
                [-11.0, 95.0],
                [  6.5, 141.0]
            ]"
        />
    </div>

    <div class="col-span-3 bg-white rounded shadow p-4 space-y-3">
        <button
            wire:click="setIndonesia"
            class="w-full bg-blue-600 text-white py-2 rounded">
            Indonesia
        </button>

        <button
            wire:click="setJakarta"
            class="w-full bg-green-600 text-white py-2 rounded">
            Jakarta
        </button>
    </div>

</div>
