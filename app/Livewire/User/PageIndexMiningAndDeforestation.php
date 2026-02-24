<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageIndexMiningAndDeforestation extends Component
{
    public $background;

    public function mount()
    {
        $this->background = DB::table('background')
            ->where('type', 'mining-and-deforestation')
            ->select('title_id', 'title_en', 'deskripsi_id', 'deskripsi_en')
            ->first();
    }

    public function render()
    {
        return view('livewire.user.page-index-mining-and-deforestation', [
            'background' => $this->background
        ]);
    }
}
