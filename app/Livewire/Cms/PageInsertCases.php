<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageInsertCases extends Component
{
    public $title_id;
    public $title_en;
    public $deskripsi_id;
    public $deskripsi_en;
    public $tanggal;
    public $status = 'Y';

    // public $image;
    // public $image_slug;

    public function save()
    {
        $slug = Str::slug($this->title_en);

        DB::table('cases')->insert([
            'title_id'      => $this->title_id,
            'title_en'      => $this->title_en,
            'deskripsi_id'  => $this->deskripsi_id,
            'deskripsi_en'  => $this->deskripsi_en,
            'tanggal'       => $this->tanggal,
            'status'        => $this->status,
            'slug'          => $slug,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        session()->flash('success', 'Cases berhasil ditambahkan');

        return redirect()->route('cms.coal-ruption.cases.index', [
            'locale' => app()->getLocale()
        ]);
    }

    public function render()
    {
        return view('livewire.cms.page-insert-cases');
    }
}
