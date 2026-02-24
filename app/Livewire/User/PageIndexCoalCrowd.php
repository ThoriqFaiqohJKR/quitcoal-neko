<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageIndexCoalCrowd extends Component
{
    public int $page = 1;
    public int $perPage = 10;
    public int $total = 0;

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
        $query = DB::table('background')
            ->where('type', 'coalcrowd')
            ->where('status', 'Y');

        $this->total = $query->count();

        $data = $query
            ->orderBy('tanggal', 'desc')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();

        return view('livewire.user.page-index-coal-crowd', [
            'data' => $data,
            'page' => $this->page,
            'lastPage' => $this->lastPage(),
            'total' => $this->total,
        ]);
    }
}
