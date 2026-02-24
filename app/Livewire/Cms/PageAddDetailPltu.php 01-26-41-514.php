<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageAddDetailPltu extends Component
{
    public $id_pltu;
    public $unit;
    public $teknologi_pembangkit;
    public $status;
    public $pulau;
    public $lokasi;
    public $kabupaten;
    public $desa;
    public $kapasitas;
    public $konsumsi_batubara;
    public $tahun_pembangunan;
    public $beroperasi;
    public $berakhir;
    public $mata_uang_investasi;
    public $nilai_investasi;
    public $program_pemerintah;
    public $lembanga_pemberi;
    public $pinjaman;
    public $mata_uang_pinjaman;
    public $nilai_pinjaman;
    public $pengelolaan;
    public $owner;
    public $pengelola;
    public $kontraktor_konstruksi;

    public function save()
    {
        $this->validate([
            'id_pltu' => 'required',
        ]);

        DB::table('detail_pltu')->insert([
            'id_pltu'                => $this->id_pltu,
            'unit'                   => $this->unit,
            'teknologi_pembangkit'   => $this->teknologi_pembangkit,
            'status'                 => $this->status,
            'pulau'                  => $this->pulau,
            'lokasi'                 => $this->lokasi,
            'kabupaten'              => $this->kabupaten,
            'desa'                   => $this->desa,
            'kapasitas'              => $this->kapasitas,
            'konsumsi_batubara'      => $this->konsumsi_batubara,
            'tahun_pembangunan'      => $this->tahun_pembangunan,
            'beroperasi'             => $this->beroperasi,
            'berakhir'               => $this->berakhir,
            'mata_uang_investasi'    => $this->mata_uang_investasi,
            'nilai_investasi'        => $this->nilai_investasi,
            'program_pemerintah'     => $this->program_pemerintah,
            'lembanga_pemberi'       => $this->lembanga_pemberi,
            'pinjaman'               => $this->pinjaman,
            'mata_uang_pinjaman'     => $this->mata_uang_pinjaman,
            'nilai_pinjaman'         => $this->nilai_pinjaman,
            'pengelolaan'            => $this->pengelolaan,
            'owner'                  => $this->owner,
            'pengelola'              => $this->pengelola,
            'kontraktor_konstruksi'  => $this->kontraktor_konstruksi,
            'created_at'             => now(),
            'updated_at'             => now(),
        ]);

        session()->flash('success', 'Detail PLTU berhasil ditambahkan');

        return redirect()->route('cms.detail-pltu.index');
    }

    public function render()
    {
        $pltu = DB::table('profil_pltu')
            ->orderBy('nama')
            ->get();

        return view('livewire.cms.page-add-detail-pltu', [
            'pltu' => $pltu,
        ]);
    }
}
