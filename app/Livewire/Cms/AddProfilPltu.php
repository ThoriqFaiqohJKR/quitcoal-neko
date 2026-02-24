<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class AddProfilPltu extends Component
{
    use WithFileUploads;
    public $activeMenu = 'profil';
    public $image;

    public $nama;
    public $luas;

    public $organisasi_id;
    public $organisasi_en;

    public $tipologi_id;
    public $tipologi_en;

    public $penggunaan_id;
    public $penggunaan_en;

    public $overview_id;
    public $overview_en;

    public $corporate_id;
    public $corporate_en;

    public $environment_id;
    public $environment_en;

    public $spotlight_id;
    public $spotlight_en;

    public $desa = '';
    public $desaResults = [];
    public $desaSelected = null;

    public $level_2;
    public $level_3;
    public $level_4;
    public $level_5;
    public $level_6;

    public $latitude = null;
    public $longitude = null;

    
    protected $rules = [
        'nama' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ];

    public function updatedDesa()
    {
        $q = trim($this->desa);

        if (strlen($q) < 3) {
            $this->desaResults = [];
            return;
        }

        $key = ucwords(strtolower($q));

        $res = Http::get('https://aws.simontini.id/geoserver/proteus/ows', [
            'service' => 'WFS',
            'version' => '1.1.0',
            'request' => 'GetFeature',
            'typeName' => 'proteus:POLITICAL_LEVEL_6_dissolved',
            'outputFormat' => 'application/json',
            'srsName' => 'EPSG:4326',
            'CQL_FILTER' => "LEVEL_6 LIKE '%{$key}%' OR NAME_EN_US LIKE '%{$key}%'",
            'maxFeatures' => 15,
        ]);

        if (!$res->successful()) {
            $this->desaResults = [];
            return;
        }

        $this->desaResults = collect($res->json('features') ?? [])
            ->map(function ($f) {
                $p = $f['properties'];

                return [
                    'label' =>
                        ($p['LEVEL_6'] ?? '-') . ' [' .
                        ($p['LEVEL_5'] ?? '-') . '] [' .
                        ($p['LEVEL_4'] ?? '-') . '] [' .
                        ($p['LEVEL_3'] ?? '-') . '] [' .
                        ($p['LEVEL_2'] ?? '-') . '] [Indonesia]',

                    'level_6' => $p['LEVEL_6'] ?? null,
                    'level_5' => $p['LEVEL_5'] ?? null,
                    'level_4' => $p['LEVEL_4'] ?? null,
                    'level_3' => $p['LEVEL_3'] ?? null,
                    'level_2' => $p['LEVEL_2'] ?? null,
                    'geometry' => $f['geometry'] ?? null,
                ];
            })
            ->values()
            ->toArray();

    }

    public function pilihDesa($index)
    {
        if (!isset($this->desaResults[$index]))
            return;

        $this->desaSelected = $this->desaResults[$index];
        $this->desa = $this->desaSelected['level_6'];

        $this->desaResults = [];

        $this->level_2 = $this->desaSelected['level_2'];
        $this->level_3 = $this->desaSelected['level_3'];
        $this->level_4 = $this->desaSelected['level_4'];
        $this->level_5 = $this->desaSelected['level_5'];
        $this->level_6 = $this->desaSelected['level_6'];

        $this->dispatch('zoom-map', geometry: $this->desaSelected['geometry']);
    }


    #[On('setPltuPoint')]
    public function setPltuPoint($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }


    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('pltu', 'public');
        }

        DB::table('profil_pltu')->insert([
            'image' => $imagePath,

            'nama' => $this->nama,
            'luas' => $this->luas,

            'organisasi_id' => $this->organisasi_id,
            'organisasi_en' => $this->organisasi_en,

            'tipologi_id' => $this->tipologi_id,
            'tipologi_en' => $this->tipologi_en,

            'penggunaan_id' => $this->penggunaan_id,
            'penggunaan_en' => $this->penggunaan_en,

            'overview_id' => $this->overview_id,
            'overview_en' => $this->overview_en,

            'corporate_id' => $this->corporate_id,
            'corporate_en' => $this->corporate_en,

            'environment_id' => $this->environment_id,
            'environment_en' => $this->environment_en,

            'spotlight_id' => $this->spotlight_id,
            'spotlight_en' => $this->spotlight_en,

            'level_2' => $this->level_2,
            'level_3' => $this->level_3,
            'level_4' => $this->level_4,
            'level_5' => $this->level_5,
            'level_6' => $this->level_6,

            'latitude' => $this->latitude,
            'longitude' => $this->longitude,

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->reset();
        session()->flash('success', 'Profil PLTU berhasil disimpan');
    }

    public function setMenuLokasi()
    {
        $this->activeMenu = 'lokasi';

        $this->dispatch('init-pltu-map');
    }


    public function render()
    {
        return view('livewire.cms.add-profil-pltu');
    }
}
