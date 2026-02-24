<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageAbout extends Component
{
    public $about;

    public function mount()
    {
        $this->about = DB::table('about')->first();
    }

    public function render()
    {
        return view('livewire.user.page-about');
    }
}
