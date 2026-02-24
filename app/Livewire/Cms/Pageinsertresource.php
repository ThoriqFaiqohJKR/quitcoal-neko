<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pageinsertresource extends Component
{
    use WithFileUploads;

    public $title_id, $title_en;
    public $deskripsi_id, $deskripsi_en;

    public $file_id;
    public $file_en;

    public $file_name_id;
    public $file_name_en;

    public function store()
    {
        $this->validate([
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',

            // jangan pakai rule "file|" biar livewire lebih stabil
            'file_id' => 'nullable|mimes:pdf|max:10240',
            'file_en' => 'nullable|mimes:pdf|max:10240',

            'file_name_id' => 'nullable|string|max:255',
            'file_name_en' => 'nullable|string|max:255',
        ]);

        try {
            $fileIdPath = null;
            $fileEnPath = null;

            if ($this->file_id) {
                $baseName = $this->file_name_id ?: ($this->title_id ?: 'resource-id');
                $safeName = Str::slug($baseName);

                $name = $safeName . '-' . time() . '.pdf';

                $fileIdPath = $this->file_id->storeAs('resources', $name, 'public');
            }

            if ($this->file_en) {
                $baseName = $this->file_name_en ?: ($this->title_en ?: 'resource-en');
                $safeName = Str::slug($baseName);

                $name = $safeName . '-' . time() . '.pdf';

                $fileEnPath = $this->file_en->storeAs('resources', $name, 'public');
            }

            DB::table('resources')->insert([
                'title_id' => $this->title_id,
                'title_en' => $this->title_en,
                'deskripsi_id' => $this->deskripsi_id,
                'deskripsi_en' => $this->deskripsi_en,
                'file_id' => $fileIdPath,
                'file_en' => $fileEnPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            session()->flash('success', 'Resource berhasil ditambahkan.');

            return redirect()->route('cms.data.resource.index', [
                'locale' => app()->getLocale()
            ]);
        } catch (\Throwable $e) {
            session()->flash('error', 'Upload gagal: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.cms.pageinsertresource');
    }
}
