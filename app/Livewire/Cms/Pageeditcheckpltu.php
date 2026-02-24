<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class Pageeditcheckpltu extends Component
{
    use WithFileUploads;

    public $id_pltu, $activeMenu = 'profil';

    public $image, $oldImage;

    public $nama_pltu, $unit, $teknologi_pembangkit, $status, $kapasitas, $konsumsi_batubara_tahun,
        $tahun_pembangunan, $beroperasi, $berakhir, $mata_uang_nilai_investasi, $nilai_investasi,
        $program_pemerintah, $lembaga_pemberi_pinjaman, $pinjaman, $mata_uang_nilai_pinjaman, $nilai_pinjaman,
        $pengelolaan_1, $pengelolaan_2, $pengelola, $kontraktor_konstruksi,
        $combustion_technology, $coal_type, $coal_source, $alternate_fuel,
        $captive, $captive_industry_use, $captive_residential_use,
        $plant_age_years, $reference,
        $overview_id, $overview_en, $corporate_id, $corporate_en,
        $environment_id, $environment_en, $spotlight_id, $spotlight_en,
        $level_2, $level_3, $level_4, $level_5, $level_6,
        $latitude, $longitude;

    public $desa = '';
    public $desaResults = [];
    public $desaSelected = null;

    public function mount($id)
    {
        $this->id_pltu = $id;

        $pltu = DB::table('profil_pltu')->where('id', $id)->first();
        if (!$pltu) abort(404);

        $this->nama_pltu = $pltu->nama_pltu;
        $this->unit = $pltu->unit;
        $this->teknologi_pembangkit = $pltu->teknologi_pembangkit;
        $this->status = $pltu->status;
        $this->kapasitas = $pltu->kapasitas;
        $this->konsumsi_batubara_tahun = $pltu->konsumsi_batubara_tahun;

        $this->tahun_pembangunan = $pltu->tahun_pembangunan;
        $this->beroperasi = $pltu->beroperasi;
        $this->berakhir = $pltu->berakhir;

        $this->mata_uang_nilai_investasi = $pltu->mata_uang_nilai_investasi;
        $this->nilai_investasi = $pltu->nilai_investasi;

        $this->program_pemerintah = $pltu->program_pemerintah;

        $this->lembaga_pemberi_pinjaman = $pltu->lembaga_pemberi_pinjaman;
        $this->pinjaman = $pltu->pinjaman;

        $this->mata_uang_nilai_pinjaman = $pltu->mata_uang_nilai_pinjaman;
        $this->nilai_pinjaman = $pltu->nilai_pinjaman;

        $this->pengelolaan_1 = $pltu->pengelolaan_1;
        $this->pengelolaan_2 = $pltu->pengelolaan_2;

        $this->pengelola = $pltu->pengelola;
        $this->kontraktor_konstruksi = $pltu->kontraktor_konstruksi;

        $this->combustion_technology = $pltu->combustion_technology;
        $this->coal_type = $pltu->coal_type;
        $this->coal_source = $pltu->coal_source;
        $this->alternate_fuel = $pltu->alternate_fuel;

        $this->captive = $pltu->captive;
        $this->captive_industry_use = $pltu->captive_industry_use;
        $this->captive_residential_use = $pltu->captive_residential_use;

        $this->plant_age_years = $pltu->plant_age_years;
        $this->reference = $pltu->reference;

        $this->overview_id = $pltu->overview_id;
        $this->overview_en = $pltu->overview_en;

        $this->corporate_id = $pltu->corporate_id;
        $this->corporate_en = $pltu->corporate_en;

        $this->environment_id = $pltu->environment_id;
        $this->environment_en = $pltu->environment_en;

        $this->spotlight_id = $pltu->spotlight_id;
        $this->spotlight_en = $pltu->spotlight_en;

        $this->level_2 = $pltu->level_2;
        $this->level_3 = $pltu->level_3;
        $this->level_4 = $pltu->level_4;
        $this->level_5 = $pltu->level_5;
        $this->level_6 = $pltu->level_6;

        $this->desa = $pltu->level_6;

        $this->latitude = $pltu->latitude;
        $this->longitude = $pltu->longitude;

        $this->oldImage = $pltu->image;
    }

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
        if (!isset($this->desaResults[$index])) return;

        $this->desaSelected = $this->desaResults[$index];
        $this->desa = $this->desaSelected['level_6'];
        $this->desaResults = [];

        $this->level_2 = $this->desaSelected['level_2'];
        $this->level_3 = $this->desaSelected['level_3'];
        $this->level_4 = $this->desaSelected['level_4'];
        $this->level_5 = $this->desaSelected['level_5'];
        $this->level_6 = $this->desaSelected['level_6'];

        $this->dispatch('show-desa-wms', level_6: $this->level_6);
    }

    public function setMenuLokasi()
    {
        $this->activeMenu = 'lokasi';

        $this->dispatch('init-pltu-map');

        if ($this->latitude && $this->longitude) {
            $this->dispatch('set-marker', latitude: $this->latitude, longitude: $this->longitude);
        }

        if ($this->level_6) {
            $this->dispatch('show-desa-wms', level_6: $this->level_6);
        }
    }

    #[On('setPltuPoint')]
    public function setPltuPoint($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function update()
    {
        $this->validate([
            'nama_pltu' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->oldImage;

        if ($this->image) {
            $imagePath = $this->image->store('pltu', 'public');
        }

        DB::table('profil_pltu')->where('id', $this->id_pltu)->update([
            'nama_pltu' => $this->nama_pltu,
            'unit' => $this->unit,
            'image' => $imagePath,

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

            'captive' => $this->captive ? 1 : 0,
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

            'slug' => Str::slug($this->nama_pltu),

            'updated_at' => now(),
        ]);

        session()->flash('success', 'Data PLTU berhasil diupdate.');

        return redirect()->route('cms.data.check-pltu.detail', [
            'id' => $this->id_pltu,
            'locale' => app()->getLocale()
        ]);
    }

    public function render()
    {
        return view('livewire.cms.pageeditcheckpltu');
    }
}
