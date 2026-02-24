<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageIndexRegulation extends Component
{
    public $regulations = [];

    public function mount()
    {
        $this->regulations = DB::table('background')
            ->where('type', 'regulation')
            ->select('title_id', 'title_en', 'deskripsi_id', 'deskripsi_en', 'image')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.user.page-index-regulation', [
            'regulations' => $this->regulations
        ]);
    }
}
