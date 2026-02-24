<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Pageindexaction extends Component
{
    public int $page = 1;
    public int $perPage = 6;
    public int $total = 0;

    protected $queryString = ['page'];

    public function lastPage(): int
    {
        return max(1, (int) ceil($this->total / $this->perPage));
    }

    public function goToPage($page)
    {
        $this->page = max(1, min((int) $page, $this->lastPage()));
    }

    public function prevPage()
    {
        $this->goToPage($this->page - 1);
    }

    public function nextPage()
    {
        $this->goToPage($this->page + 1);
    }

    public function render()
    {
        $locale = app()->getLocale();

        $judulField = $locale == 'en' ? 'judul_en' : 'judul_id';
        $descField  = $locale == 'en' ? 'deskripsi_en' : 'deskripsi_id';
        $flyerField = $locale == 'en' ? 'flayer_en' : 'flayer_id';

        $query = DB::table('action');

        $this->total = $query->count();

        $actions = $query
            ->select(
                'id',
                'slug',
                DB::raw("$judulField as judul"),
                DB::raw("$descField as deskripsi"),
                DB::raw("$flyerField as flyer")
            )
            ->orderBy('id', 'desc')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();

        return view('livewire.user.pageindexaction', [
            'actions' => $actions,
            'page' => $this->page,
            'lastPage' => $this->lastPage(),
        ]);
    }
}
