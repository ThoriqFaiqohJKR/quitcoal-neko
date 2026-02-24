<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageEditRegulation extends Component
{
    public $id;
    public $isEdit = false;

    public $title_id;
    public $title_en;
    public $deskripsi_id;
    public $deskripsi_en;
    public $tanggal;
    public $status;

    public function mount($id)
    {
        $this->id = $id;

        $data = DB::table('background')
            ->where('id', $id)
            ->where('type', 'regulation')
            ->first();

        abort_if(!$data, 404);

        $this->title_id      = $data->title_id;
        $this->title_en      = $data->title_en;
        $this->deskripsi_id  = $data->deskripsi_id;
        $this->deskripsi_en  = $data->deskripsi_en;
        $this->tanggal       = $data->tanggal;
        $this->status        = $data->status;
    }

    public function enableEdit()
    {
        $this->isEdit = true;
    }

    public function save()
    {
        DB::table('background')
            ->where('id', $this->id)
            ->where('type', 'regulation')
            ->update([
                'title_id'     => $this->title_id,
                'title_en'     => $this->title_en,
                'deskripsi_id' => $this->deskripsi_id,
                'deskripsi_en' => $this->deskripsi_en,
                'tanggal'      => $this->tanggal,
                'status'       => $this->status,
                'updated_at'   => now(),
            ]);

        $this->isEdit = false;
        session()->flash('success', 'Data berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.cms.page-edit-regulation');
    }
}
