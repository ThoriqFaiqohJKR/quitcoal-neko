<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageInsertCoalcrowd extends Component
{
    public $title_id;
    public $title_en;
    public $deskripsi_id;
    public $deskripsi_en;
    public $sumber;
    public $tanggal;

    // public $image;

    public function save()
    {
        DB::table('background')->insert([
            'title_id' => $this->title_id,
            'title_en' => $this->title_en,

            'deskripsi_id' => $this->deskripsi_id,
            'deskripsi_en' => $this->deskripsi_en,

            'image' => null,
            'image_slug' => null,

            'tanggal' => $this->tanggal,
            'sumber' => $this->sumber,

            'status' => 'N',
            'type' => 'coalcrowd',

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route(
            'cms.background.coalcrowd.index',
            app()->getLocale()
        );
    }

    public function render()
    {
        return view('livewire.cms.page-insert-coalcrowd');
    }
}
