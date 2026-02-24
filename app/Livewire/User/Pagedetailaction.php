<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Pagedetailaction extends Component
{
    public $id;
    public $locale;

    public $item = [];

    public function mount($id, $locale)
    {
        $this->id = $id;
        $this->locale = $locale;

        $data = DB::table('action')->where('id', $id)->first();
        if (!$data)
            abort(404);

        if ($locale == 'en') {
            $this->item = [
                'title' => $data->judul_en ?? '-',
                'description' => $data->deskripsi_en ?? '-',
                'content' => $data->isi_en ?? '-',
                'flyer' => $data->flayer_en,
            ];
        } else {
            $this->item = [
                'title' => $data->judul_id ?? '-',
                'description' => $data->deskripsi_id ?? '-',
                'content' => $data->isi_id ?? '-',
                'flyer' => $data->flayer_id,
            ];
        }
    }

    public function render()
    {
        return view('livewire.user.pagedetailaction');
    }
}
