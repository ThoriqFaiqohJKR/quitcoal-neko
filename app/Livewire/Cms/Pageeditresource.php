<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pageeditresource extends Component
{
    use WithFileUploads;

    public $id;

    public $title_id, $title_en;
    public $deskripsi_id, $deskripsi_en;

    public $file_id;
    public $file_en;

    public $old_file_id;
    public $old_file_en;

    public $file_name_id;
    public $file_name_en;

    public function mount($id)
    {
        $this->id = $id;

        $data = DB::table('resources')->where('id', $id)->first();

        if (!$data) {
            abort(404);
        }

        $this->title_id = $data->title_id;
        $this->title_en = $data->title_en;
        $this->deskripsi_id = $data->deskripsi_id;
        $this->deskripsi_en = $data->deskripsi_en;

        $this->old_file_id = $data->file_id;
        $this->old_file_en = $data->file_en;
    }

    public function update()
    {
        $this->validate([
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',

            'file_id' => 'nullable|file|mimes:pdf|max:10240',
            'file_en' => 'nullable|file|mimes:pdf|max:10240',

            'file_name_id' => 'nullable|string|max:255',
            'file_name_en' => 'nullable|string|max:255',
        ]);

        $fileIdPath = $this->old_file_id;
        $fileEnPath = $this->old_file_en;

        if ($this->file_id) {
            $name = $this->file_name_id
                ? Str::slug($this->file_name_id) . '.pdf'
                : time() . '_id.pdf';

            $fileIdPath = $this->file_id->storeAs('resources', $name, 'public');
        }

        if ($this->file_en) {
            $name = $this->file_name_en
                ? Str::slug($this->file_name_en) . '.pdf'
                : time() . '_en.pdf';

            $fileEnPath = $this->file_en->storeAs('resources', $name, 'public');
        }

        DB::table('resources')->where('id', $this->id)->update([
            'title_id' => $this->title_id,
            'title_en' => $this->title_en,
            'deskripsi_id' => $this->deskripsi_id,
            'deskripsi_en' => $this->deskripsi_en,
            'file_id' => $fileIdPath,
            'file_en' => $fileEnPath,
            'updated_at' => now(),
        ]);

        session()->flash('success', 'Resource berhasil diperbarui.');

        return redirect()->route('cms.data.resource.index', [
            'locale' => app()->getLocale()
        ]);
    }

    public function render()
    {
        return view('livewire.cms.pageeditresource');
    }
}
