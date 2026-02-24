<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pageeditngopini extends Component
{
    use WithFileUploads;

    public $id;

    public $old_flayer_id;
    public $old_flayer_en;

    public $flayer_id;
    public $flayer_en;

    public $judul_id;
    public $judul_en;

    public $deskripsi_id;
    public $deskripsi_en;

    public $isi_id;
    public $isi_en;

    public function mount( $id)
    {
        $this->id = $id;

        $data = DB::table('ngopini')->where('id', $id)->first();

        if (!$data) {
            abort(404);
        }

        $this->old_flayer_id = $data->flayer_id;
        $this->old_flayer_en = $data->flayer_en;

        $this->judul_id = $data->judul_id;
        $this->judul_en = $data->judul_en;

        $this->deskripsi_id = $data->deskripsi_id;
        $this->deskripsi_en = $data->deskripsi_en;

        $this->isi_id = $data->isi_id;
        $this->isi_en = $data->isi_en;
    }


    public function update()
    {
        $this->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'isi_id' => 'nullable|string',
            'isi_en' => 'nullable|string',
            'flayer_id' => 'nullable|image|max:2048',
            'flayer_en' => 'nullable|image|max:2048',
        ]);

        $judulEn = $this->judul_en ?: $this->judul_id;
        $slug = Str::slug($this->judul_id);

        $exists = DB::table('ngopini')
            ->where('slug', $slug)
            ->where('id', '!=', $this->id)
            ->exists();

        if ($exists) {
            $slug .= '-' . time();
        }

        $flayerIdPath = $this->old_flayer_id;
        if ($this->flayer_id) {
            $flayerIdPath = $this->flayer_id->store('ngopini', 'public');
        }

        $flayerEnPath = $this->old_flayer_en;
        if ($this->flayer_en) {
            $flayerEnPath = $this->flayer_en->store('ngopini', 'public');
        }

        if (!$flayerEnPath) {
            $flayerEnPath = $flayerIdPath;
        }

        DB::table('ngopini')->where('id', $this->id)->update([
            'flayer_id' => $flayerIdPath,
            'flayer_en' => $flayerEnPath,
            'judul_id' => $this->judul_id,
            'judul_en' => $judulEn,
            'deskripsi_id' => $this->deskripsi_id,
            'deskripsi_en' => $this->deskripsi_en,
            'isi_id' => $this->isi_id,
            'isi_en' => $this->isi_en,
            'slug' => $slug,
            'updated_at' => now(),
        ]);

        return redirect()->route('cms.ngopini.index', ['locale' => app()->getLocale()]);
    }

    public function render()
    {
        return view('livewire.cms.pageeditngopini');
    }
}
