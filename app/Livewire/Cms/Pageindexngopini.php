<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Pageindexngopini extends Component
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
        $this->page++;
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function delete($id)
    {
        DB::table('ngopini')->where('id', $id)->delete();
    }

    public function render()
    {
        $query = DB::table('ngopini')
            ->select('id', 'judul_id', 'deskripsi_id', 'slug', 'created_at')
            ->when($this->search, function ($q) {
                $q->where('judul_id', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi_id', 'like', '%' . $this->search . '%');
            });

        $total = $query->count();
        $lastPage = (int) ceil($total / $this->perPage);

        $ngopinis = $query
            ->orderByDesc('id')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();

        return view('livewire.cms.pageindexngopini', [
            'ngopinis' => $ngopinis,
            'lastPage' => $lastPage,
        ]);
    }
}
