<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// use Livewire\WithFileUploads;

class PageEditCases extends Component
{
    // use WithFileUploads;

    public $caseId;

    public $title_id;
    public $title_en;
    public $deskripsi_id;
    public $deskripsi_en;
    public $tanggal;
    public $status;

    // public $image;
    // public $image_old;

    public function mount($id)
    {
        $data = DB::table('cases')->where('id', $id)->first();

        if (!$data) {
            abort(404);
        }

        $this->caseId = $data->id;
        $this->title_id = $data->title_id;
        $this->title_en = $data->title_en;
        $this->deskripsi_id = $data->deskripsi_id;
        $this->deskripsi_en = $data->deskripsi_en;
        $this->tanggal = $data->tanggal;
        $this->status = $data->status;

        // $this->image_old = $data->image;
    }

    public function update()
    {
        $slug = Str::slug($this->title_en);

        DB::table('cases')->where('id', $this->caseId)->update([
            'title_id'      => $this->title_id,
            'title_en'      => $this->title_en,
            'deskripsi_id'  => $this->deskripsi_id,
            'deskripsi_en'  => $this->deskripsi_en,
            'tanggal'       => $this->tanggal,
            'status'        => $this->status,
            'slug'          => $slug,
            'updated_at'    => now(),
        ]);

        session()->flash('success', 'Cases berhasil diupdate');
    }

    public function delete()
    {
        DB::table('cases')->where('id', $this->caseId)->delete();

        session()->flash('success', 'Cases berhasil dihapus');

        return redirect()->route('cms.coal-ruption.cases.index', [
            'locale' => app()->getLocale()
        ]);
    }

    public function render()
    {
        return view('livewire.cms.page-edit-cases');
    }
}
