<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageIndexCoalProduction extends Component
{
    public $id;
    public $title_id;
    public $title_en;
    public $description_id;
    public $description_en;
    public $image;
    public $tanggal;

    public function mount()
    {
        $data = DB::table('background')
            ->where('type', 'coal-production')
            ->first();

        if (!$data) {
            $this->id = DB::table('background')->insertGetId([
                'type' => 'coal-production',
                'status' => 'N',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return;
        }

        $this->id = $data->id;
        $this->title_id = $data->title_id;
        $this->title_en = $data->title_en;
        $this->description_id = $data->deskripsi_id;
        $this->description_en = $data->deskripsi_en;
        $this->image = $data->image;
        $this->tanggal = $data->tanggal;
    }

    public function save()
    {
        if (!$this->id) {
            return;
        }

        $lama = DB::table('background')
            ->where('id', $this->id)
            ->where('type', 'coal-production')
            ->first();

        if (!$lama) {
            return;
        }

        $payload = [
            'title_id' => $this->title_id,
            'title_en' => $this->title_en ?: $this->title_id,
            'deskripsi_id' => $this->description_id,
            'deskripsi_en' => $this->description_en,
            'image' => $this->image,
            'tanggal' => $this->tanggal,
        ];

        $changed = false;

        foreach ($payload as $key => $value) {
            $old = $lama->$key ?? null;
            $new = $value === '' ? null : $value;

            if ($old != $new) {
                $changed = true;
                break;
            }
        }

        if (!$changed) {
            return;
        }

        DB::table('background')
            ->where('id', $this->id)
            ->where('type', 'coal-production')
            ->update($payload + [
                'updated_at' => now(),
            ]);

        session()->flash('success', 'Data berhasil disimpan');
    }



    public function render()
    {
        return view('livewire.cms.page-index-coal-production');
    }
}
