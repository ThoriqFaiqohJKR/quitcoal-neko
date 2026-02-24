<?php

namespace App\Livewire\Cms;

use Livewire\Component;

class CmsMap extends Component
{
    public float $lat = -6.200000;
    public float $lng = 106.816666;
    public int $zoom = 11;

    public function setCenter($lat, $lng, $zoom = 11)
    {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->zoom = $zoom;

        $this->dispatch('update-map', lat: $lat, lng: $lng, zoom: $zoom);
    }

    public function render()
    {
        return view('livewire.cms.cms-map');
    }
}
