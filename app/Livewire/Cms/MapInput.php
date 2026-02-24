<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class MapInput extends Component
{
    public $desa = '';
    public $desaResults = [];
    public $desaSelected = null;

    public $pltu_lat = null;
    public $pltu_lon = null;

    public function updatedDesa()
    {
        $q = trim($this->desa);

        if (strlen($q) < 3) {
            $this->desaResults = [];
            return;
        }

        $rows = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_6_dissolved"'))
            ->selectRaw('
                id,
                "LEVEL_6",
                "LEVEL_5",
                "LEVEL_4",
                "LEVEL_3",
                "NAME_EN_US"
            ')
            ->whereRaw('"LEVEL_6" ILIKE ?', ["%{$q}%"])
            ->orWhereRaw('"NAME_EN_US" ILIKE ?', ["%{$q}%"])
            ->limit(10)
            ->get();

        $this->desaResults = $rows->map(fn ($r) => [
            'id'        => $r->id,
            'desa'      => $r->LEVEL_6,
            'kecamatan' => $r->LEVEL_5,
            'kabupaten' => $r->LEVEL_4,
            'provinsi'  => $r->LEVEL_3,
            'name_full' => $r->NAME_EN_US,
        ])->toArray();
    }

    public function pilihDesa($index)
    {
        if (!isset($this->desaResults[$index])) return;

        $this->desaSelected = $this->desaResults[$index];
        $this->desa = $this->desaSelected['desa'];
        $this->desaResults = [];

        $this->pltu_lat = null;
        $this->pltu_lon = null;

        $row = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_6_dissolved"'))
            ->selectRaw('ST_AsGeoJSON("geom") AS geometry')
            ->where('id', $this->desaSelected['id'])
            ->first();

        if (!$row) return;

        $this->dispatch(
            'zoom-map',
            geometry: json_decode($row->geometry, true)
        );
    }

    #[On('setPltuPoint')]
    public function setPltuPoint($data)
    {
        $this->pltu_lat = $data['latitude'] ?? null;
        $this->pltu_lon = $data['longitude'] ?? null;
    }

    public function save()
    {
        if (!$this->desaSelected || !$this->pltu_lat || !$this->pltu_lon) return;

        DB::table('lokasi_desa')->updateOrInsert(
            [
                'desa' => $this->desaSelected['desa'],
            ],
            [
                'kecamatan' => $this->desaSelected['kecamatan'],
                'latitude'  => $this->pltu_lat,
                'longitude' => $this->pltu_lon,
                'geometry'  => null,
                'updated_at'=> now(),
                'created_at'=> now(),
            ]
        );

        session()->flash('success', 'Lokasi PLTU berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.cms.map-input');
    }
}
