<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageDetailCheckPltu extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $pltu = DB::table('profil_pltu')
            ->where('id', $this->id)
            ->first();

        return view('livewire.cms.page-detail-check-pltu', [
            'pltu' => $pltu,
        ]);
    }
}
