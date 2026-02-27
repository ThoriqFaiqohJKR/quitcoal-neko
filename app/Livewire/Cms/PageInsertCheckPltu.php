<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class PageInsertCheckPltu extends Component
{
    use WithFileUploads;

    public $activeMenu = 'profil';
    public $image;

    public $nama_pltu;
    public $unit;

    public $teknologi_pembangkit;
    public $status;

    public $kapasitas;
    public $konsumsi_batubara_tahun;

    public $tahun_pembangunan;
    public $beroperasi;
    public $berakhir;

    public $mata_uang_nilai_investasi;
    public $nilai_investasi;

    public $program_pemerintah;

    public $lembaga_pemberi_pinjaman;
    public $pinjaman;

    public $mata_uang_nilai_pinjaman;
    public $nilai_pinjaman;

    public $pengelolaan_1;
    public $pengelolaan_2;

    public $pengelola;
    public $kontraktor_konstruksi;

    public $combustion_technology;
    public $coal_type;
    public $coal_source;
    public $alternate_fuel;

    public $captive;
    public $captive_industry_use;
    public $captive_residential_use;

    public $plant_age_years;
    public $reference;

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
        'nama_pltu' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'tahun_pembangunan' => 'nullable|integer|between:1000,9999',
        'beroperasi' => 'nullable|integer|between:1000,9999',
        'berakhir' => 'nullable|integer|between:1000,9999',
    ];

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
                "LEVEL_2",
                "NAME_EN_US"
            ')
            ->whereRaw('"LEVEL_6" ILIKE ?', ["%{$q}%"])
            ->orWhereRaw('"NAME_EN_US" ILIKE ?', ["%{$q}%"])
            ->limit(15)
            ->get();

        $this->desaResults = $rows->map(function ($r) {
            return [
                'id' => $r->id,
                'label' =>
                    ($r->LEVEL_6 ?? '-') . ' [' .
                    ($r->LEVEL_5 ?? '-') . '] [' .
                    ($r->LEVEL_4 ?? '-') . '] [' .
                    ($r->LEVEL_3 ?? '-') . '] [' .
                    ($r->LEVEL_2 ?? '-') . '] [Indonesia]',
                'level_6' => $r->LEVEL_6 ?? null,
                'level_5' => $r->LEVEL_5 ?? null,
                'level_4' => $r->LEVEL_4 ?? null,
                'level_3' => $r->LEVEL_3 ?? null,
                'level_2' => $r->LEVEL_2 ?? null,
            ];
        })->toArray();
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

        $row = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_6_dissolved"'))
            ->selectRaw('ST_AsGeoJSON("geom") AS geometry')
            ->where('id', $this->desaSelected['id'])
            ->first();

        if (!$row)
            return;

        $this->dispatch('zoom-map', geometry: json_decode($row->geometry, true));
    }

    #[On('setPltuPoint')]
    public function setPltuPoint($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function setMenuLokasi()
    {
        $this->activeMenu = 'lokasi';
        $this->dispatch('refresh-map');
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

            'nama_pltu' => $this->nama_pltu,
            'unit' => $this->unit,

            'teknologi_pembangkit' => $this->teknologi_pembangkit,
            'status' => $this->status,

            'kapasitas' => $this->kapasitas,
            'konsumsi_batubara_tahun' => $this->konsumsi_batubara_tahun,

            'tahun_pembangunan' => $this->tahun_pembangunan,
            'beroperasi' => $this->beroperasi,
            'berakhir' => $this->berakhir,

            'mata_uang_nilai_investasi' => $this->mata_uang_nilai_investasi,
            'nilai_investasi' => $this->nilai_investasi,

            'program_pemerintah' => $this->program_pemerintah,

            'lembaga_pemberi_pinjaman' => $this->lembaga_pemberi_pinjaman,
            'pinjaman' => $this->pinjaman,

            'mata_uang_nilai_pinjaman' => $this->mata_uang_nilai_pinjaman,
            'nilai_pinjaman' => $this->nilai_pinjaman,

            'pengelolaan_1' => $this->pengelolaan_1,
            'pengelolaan_2' => $this->pengelolaan_2,

            'pengelola' => $this->pengelola,
            'kontraktor_konstruksi' => $this->kontraktor_konstruksi,

            'combustion_technology' => $this->combustion_technology,
            'coal_type' => $this->coal_type,
            'coal_source' => $this->coal_source,
            'alternate_fuel' => $this->alternate_fuel,

            'captive' => $this->captive,
            'captive_industry_use' => $this->captive_industry_use,
            'captive_residential_use' => $this->captive_residential_use,

            'plant_age_years' => $this->plant_age_years,
            'reference' => $this->reference,

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
        $this->activeMenu = 'profil';

        session()->flash('success', 'Profil PLTU berhasil disimpan');

        return redirect()->route('cms.data.check-pltu.index', ['locale' => app()->getLocale()]);
    }

    public function render()
    {
        return view('livewire.cms.page-insert-check-pltu');
    }
}
