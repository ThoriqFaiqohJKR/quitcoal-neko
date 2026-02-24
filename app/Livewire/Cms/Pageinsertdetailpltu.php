<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Pageinsertdetailpltu extends Component
{
    public $id_pltu;
    public $listPltu = [];

    public $nama_pembangkit;
    public $nama_unit;

    public $pemilik;
    public $pemilik_detail;

    public $kapasitas;
    public $status;
    public $start_year;

    public $combustion_technology;
    public $coal_type;
    public $coal_source;
    public $alternate_fuel;

    public $location;
    public $local_area;
    public $major_area;
    public $subnational_unit;

    public $captive = 0;
    public $captive_industry_use;
    public $captive_residential_use;

    public $plant_age_years;

    public function save()
    {
        $this->validate([
            'id_pltu' => 'required',
            'nama_pembangkit' => 'required|string|max:255',
        ]);

        DB::table('detail_pltu')->insert([
            'id_pltu' => $this->id_pltu,

            'nama_pembangkit' => $this->nama_pembangkit,
            'nama_unit' => $this->nama_unit,

            'pemilik' => $this->pemilik,
            'pemilik_detail' => $this->pemilik_detail,

            'kapasitas' => $this->kapasitas,
            'status' => $this->status,
            'start_year' => $this->start_year,

            'combustion_technology' => $this->combustion_technology,

            'coal_type' => $this->coal_type,
            'coal_source' => $this->coal_source,

            'alternate_fuel' => $this->alternate_fuel,

            'location' => $this->location,
            'local_area' => $this->local_area,
            'major_area' => $this->major_area,
            'subnational_unit' => $this->subnational_unit,

            'captive' => $this->captive ? 1 : 0,
            'captive_industry_use' => $this->captive_industry_use,
            'captive_residential_use' => $this->captive_residential_use,

            'plant_age_years' => $this->plant_age_years,

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('success', 'Detail PLTU berhasil disimpan.');

        return redirect()->route('cms.data.check-pltu.index', [
            'locale' => app()->getLocale()
        ]);
    }

    public function render()
    {
        $this->listPltu = DB::table('profil_pltu')
            ->select('id', 'nama_pltu')
            ->orderBy('nama_pltu', 'asc')
            ->get();

        return view('livewire.cms.pageinsertdetailpltu', [
            'listPltu' => $this->listPltu
        ]);
    }
}
