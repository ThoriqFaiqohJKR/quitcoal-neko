<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageAbout extends Component
{
    public $aboutId;

    public $title_id;
    public $title_en;
    public $description_id;
    public $description_en;
    public $content_id;
    public $content_en;
    public $image; 

    public function mount()
    {
        $about = DB::table('about')->first();

        if (!$about) {
            $this->aboutId = DB::table('about')->insertGetId([
                'title_id' => '',
                'title_en' => '',
                'description_id' => '',
                'description_en' => '',
                'content_id' => '',
                'content_en' => '',
                'image' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $about = DB::table('about')->where('id', $this->aboutId)->first();
        }

        $this->aboutId = $about->id;
        $this->title_id = $about->title_id;
        $this->title_en = $about->title_en;
        $this->description_id = $about->description_id;
        $this->description_en = $about->description_en;
        $this->content_id = $about->content_id;
        $this->content_en = $about->content_en;
        $this->image = $about->image;
    }

    public function save()
    {
        DB::table('about')
            ->where('id', $this->aboutId)
            ->update([
                'title_id' => $this->title_id,
                'title_en' => $this->title_en,
                'description_id' => $this->description_id,
                'description_en' => $this->description_en,
                'content_id' => $this->content_id,
                'content_en' => $this->content_en,
                'image' => $this->image,
                'updated_at' => now(),
            ]);

        session()->flash('success', 'About page berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.cms.page-about');
    }
}