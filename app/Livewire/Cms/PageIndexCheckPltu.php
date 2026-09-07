<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PageIndexCheckPltu extends Component
{
    use WithPagination;

    public $deleteId = null;
    public string $jenisPltu = '';
    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedJenisPltu()
    {
        $this->resetPage();
    }

    public function delete()
    {
        if ($this->deleteId) {
            DB::table('profil_pltu')->where('id', $this->deleteId)->delete();
            $this->deleteId = null;
            $this->resetPage();
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
            ->when(in_array($this->jenisPltu, ['captive', 'non captive'], true), function ($query) {
                $query->where('jenis_pltu', $this->jenisPltu);
            })
            ->when(trim($this->search) !== '', function ($query) {
                $query->where('nama_pltu', 'like', '%' . trim($this->search) . '%');
            })
            ->orderBy('nama_pltu')
            ->orderBy('id')
            ->paginate(20);

        return view('livewire.cms.page-index-check-pltu', [
            'profilPltu' => $profilPltu
        ]);
    }
}
