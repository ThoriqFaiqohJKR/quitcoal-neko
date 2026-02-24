<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pageinsertngopini extends Component
{
    use WithFileUploads;

    public $flayer_id;
    public $flayer_en;

    public $judul_id;
    public $judul_en;

    public $deskripsi_id;
    public $deskripsi_en;

    public $isi_id;
    public $isi_en;

    public function updatedFlayerEn()
    {
        if (!$this->flayer_en && $this->flayer_id) {
            $this->flayer_en = $this->flayer_id;
        }
    }

    public function store()
    {
        $this->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'isi_id' => 'nullable|string',
            'isi_en' => 'nullable|string',
            'flayer_id' => 'required|image|max:2048',
            'flayer_en' => 'nullable|image|max:2048',
        ]);

        $judulEn = $this->judul_en ?: $this->judul_id;
        $slug = Str::slug($this->judul_id);

        $exists = DB::table('ngopini')->where('slug', $slug)->exists();
        if ($exists) {
            $slug .= '-' . time();
        }

        $flayerIdPath = $this->flayer_id->store('ngopini', 'public');
        $flayerEnPath = $this->flayer_en ? $this->flayer_en->store('ngopini', 'public') : $flayerIdPath;

        DB::table('ngopini')->insert([
            'flayer_id' => $flayerIdPath,
            'flayer_en' => $flayerEnPath,
            'judul_id' => $this->judul_id,
            'judul_en' => $judulEn,
            'deskripsi_id' => $this->deskripsi_id,
            'deskripsi_en' => $this->deskripsi_en,
            'isi_id' => $this->isi_id,
            'isi_en' => $this->isi_en,
            'slug' => $slug,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('cms.ngopini.index', ['locale' => app()->getLocale()]);
    }

    public function render()
    {
        return view('livewire.cms.pageinsertngopini');
    }
}
