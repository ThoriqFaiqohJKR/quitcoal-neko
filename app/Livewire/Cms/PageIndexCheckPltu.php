<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageIndexCheckPltu extends Component
{
    public $deleteId = null;

    public function delete()
    {
        if ($this->deleteId) {
            DB::table('profil_pltu')->where('id', $this->deleteId)->delete();
            $this->deleteId = null;
        }
    }

    public function render()
    {
        $profilPltu = DB::table('profil_pltu')
            ->select(
                'id',
                'nama_pltu',
                'level_2 as pulau',
                'level_6 as desa',
                'status'
            )
            ->orderBy('nama_pltu')
            ->get();

        return view('livewire.cms.page-index-check-pltu', [
            'profilPltu' => $profilPltu
        ]);
    }
}
