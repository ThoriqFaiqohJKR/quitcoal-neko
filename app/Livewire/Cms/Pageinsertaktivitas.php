<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class Pageinsertaktivitas extends Component
{
    use WithFileUploads;

    public $title_id;
    public $title_en;

    public $description_id;
    public $description_en;

    public $content_id;
    public $content_en;

    public $activity_date;

    public $status = 'Y';

    public $image;

    public function save()
    {
        $this->validate([
            'title_id' => 'required|string|max:255',
            'status'   => 'required|in:Y,N',
            'image'    => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($this->image) {
            $imagePath = $this->image->store('activity', 'public');
        }

        DB::table('activity')->insert([
            'title_id'        => $this->title_id,
            'title_en'        => $this->title_en,
            'description_id'  => $this->description_id,
            'description_en'  => $this->description_en,
            'content_id'      => $this->content_id,
            'content_en'      => $this->content_en,
            'activity_date'   => $this->activity_date,
            'status'          => $this->status,
            'image'           => $imagePath,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        session()->flash('success', 'Activity berhasil ditambahkan');

        return redirect()->route('cms.activity.index', [
            'locale' => app()->getLocale()
        ]);
    }

    public function render()
    {
        return view('livewire.cms.pageinsertaktivitas');
    }
}