<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageEditDetailPltu extends Component
{
    public int $id;

    // FIELD FORM
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

    /** LOAD DATA */
    public function mount($id)
    {
        $this->id = (int) $id;

        $data = DB::table('detail_pltu')->where('id', $this->id)->first();
        if (!$data) abort(404);

        foreach ((array) $data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value === 'n.a' ? null : $value;
            }
        }
    }

    /** EDIT (UPDATE) */
    public function edit()
    {
        DB::table('detail_pltu')
            ->where('id', $this->id)
            ->update([
                'id_pltu' => $this->id_pltu,

                'unit' => $this->unit ?: 'n.a',
                'teknologi_pembangkit' => $this->teknologi_pembangkit ?: 'n.a',
                'status' => $this->status ?: 'n.a',
                'pulau' => $this->pulau ?: 'n.a',
                'lokasi' => $this->lokasi ?: 'n.a',
                'kabupaten' => $this->kabupaten ?: 'n.a',
                'desa' => $this->desa ?: 'n.a',

                'kapasitas' => $this->kapasitas ?? null,
                'konsumsi_batubara' => $this->konsumsi_batubara ?: 'n.a',
                'tahun_pembangunan' => $this->tahun_pembangunan ?? null,
                'beroperasi' => $this->beroperasi ?? null,
                'berakhir' => $this->berakhir ?? null,

                'mata_uang_investasi' => $this->mata_uang_investasi ?: 'n.a',
                'nilai_investasi' => $this->nilai_investasi ?? null,
                'program_pemerintah' => $this->program_pemerintah ?: 'n.a',
                'lembanga_pemberi' => $this->lembanga_pemberi ?: 'n.a',
                'pinjaman' => $this->pinjaman ?: 'n.a',
                'mata_uang_pinjaman' => $this->mata_uang_pinjaman ?: 'n.a',
                'nilai_pinjaman' => $this->nilai_pinjaman ?? null,

                'pengelolaan' => $this->pengelolaan ?: 'n.a',
                'owner' => $this->owner ?: 'n.a',
                'pengelola' => $this->pengelola ?: 'n.a',
                'kontraktor_konstruksi' => $this->kontraktor_konstruksi ?: 'n.a',

                'updated_at' => now(),
            ]);

        session()->flash('success', 'Detail PLTU berhasil diperbarui');

        return redirect()->route('detail-pltu');
    }

    public function render()
    {
        return view('livewire.cms.page-edit-detail-pltu', [
            'pltu' => DB::table('profil_pltu')->get(),
        ]);
    }
}
