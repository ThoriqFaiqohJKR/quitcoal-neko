<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Pageindexaction extends Component
{
    public $search = '';
    public $page = 1;
    public $perPage = 10;

    public function updatedSearch()
    {
        $this->page = 1;
    }

    public function nextPage()
    {
        if ($this->page < $this->getLastPage()) {
            $this->page++;
        }
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function delete($id)
    {
        DB::table('action')->where('id', $id)->delete();
    }

    private function baseQuery()
    {
        return DB::table('action')
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('judul_id', 'like', '%' . $this->search . '%')
                        ->orWhere('deskripsi_id', 'like', '%' . $this->search . '%');
                });
            });
    }

    private function getLastPage()
    {
        $total = $this->baseQuery()->count();
        return (int) ceil($total / $this->perPage) ?: 1;
    }

    public function render()
    {
        $query = $this->baseQuery();

        $lastPage = $this->getLastPage();

        if ($this->page > $lastPage) {
            $this->page = $lastPage;
        }

        $actions = $query
            ->select('id', 'judul_id', 'deskripsi_id', 'slug', 'created_at', 'status')
            ->orderByDesc('id')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();

        return view('livewire.cms.pageindexaction', [
            'actions' => $actions,
            'lastPage' => $lastPage,
        ]);
    }
}