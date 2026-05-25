<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PageProfilPltuIndex extends Component
{
    public $pltu;

    public function mount()
    {
        $id = request()->query('id');

        $query = DB::table('profil_pltu');
        if ($id) {
            $query->where('id', $id);
        }

        $this->pltu = $query->first();

        if (!$this->pltu) {
            $this->pltu = DB::table('profil_pltu')->orderBy('id')->first();
        }
    }

    public function render()
    {
        return view('livewire.user.page-profil-pltu-index', [
            'pltu' => $this->pltu
        ]);
    }
}
