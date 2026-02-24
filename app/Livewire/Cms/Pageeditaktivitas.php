<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Pageeditaktivitas extends Component
{
    use WithFileUploads;

    public $activityId;

    public $title_id;
    public $title_en;

    public $description_id;
    public $description_en;

    public $content_id;
    public $content_en;

    public $activity_date;
    public $status;

    public $image;
    public $oldImage;

    public $isEditing = false;

    public function mount($id)
    {
        $data = DB::table('activity')->where('id', $id)->first();

        abort_if(!$data, 404);

        $this->activityId      = $data->id;
        $this->title_id        = $data->title_id;
        $this->title_en        = $data->title_en;
        $this->description_id  = $data->description_id;
        $this->description_en  = $data->description_en;
        $this->content_id      = $data->content_id;
        $this->content_en      = $data->content_en;
        $this->activity_date   = $data->activity_date;
        $this->status          = $data->status;
        $this->oldImage        = $data->image;
    }

    public function enableEdit()
    {
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->image = null;
    }

    public function update()
    {
        $this->validate([
            'title_id' => 'required|string|max:255',
            'status'   => 'required|in:Y,N',
            'image'    => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->oldImage;

        if ($this->image) {

            if ($this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }

            $imagePath = $this->image->store('activity', 'public');
        }

        DB::table('activity')
            ->where('id', $this->activityId)
            ->update([
                'title_id'       => $this->title_id,
                'title_en'       => $this->title_en,
                'description_id' => $this->description_id,
                'description_en' => $this->description_en,
                'content_id'     => $this->content_id,
                'content_en'     => $this->content_en,
                'activity_date'  => $this->activity_date,
                'status'         => $this->status,
                'image'          => $imagePath,
                'updated_at'     => now(),
            ]);

        $this->oldImage  = $imagePath;
        $this->isEditing = false;

        session()->flash('success', 'Activity berhasil diperbarui');
    }

    public function render()
    {
        return view('livewire.cms.pageeditaktivitas');
    }
}