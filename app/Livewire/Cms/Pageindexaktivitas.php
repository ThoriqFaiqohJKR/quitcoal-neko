<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Pageindexaktivitas extends Component
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
        DB::table('activity')->where('id', $id)->delete();
    }

    public function render()
    {
        $query = DB::table('activity')
            ->select(
                'id',
                'title_id',
                'description_id',
                'status',
                'created_at'
            )
            ->when($this->search, function ($q) {
                $q->where('title_id', 'like', '%' . $this->search . '%')
                  ->orWhere('description_id', 'like', '%' . $this->search . '%');
            });

        $total = $query->count();
        $lastPage = (int) ceil($total / $this->perPage);

        if ($this->page > $lastPage && $lastPage > 0) {
            $this->page = $lastPage;
        }

        $activitys = $query
            ->orderByDesc('id')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();

        return view('livewire.cms.pageindexaktivitas', [
            'activitys' => $activitys,
            'lastPage' => $lastPage,
        ]);
    }
}