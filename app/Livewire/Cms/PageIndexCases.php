<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageIndexCases extends Component
{
    public $search = '';

    public int $page = 1;
    public int $perPage = 10;
    public int $total = 0;

    protected $queryString = ['search', 'page'];

    public function updatingSearch()
    {
        $this->page = 1;
    }

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

    public function getDescriptionPreviewProperty()
    {
        return function ($item) {
            $text = app()->getLocale() === 'en'
                ? ($item->deskripsi_en ?? '')
                : ($item->deskripsi_id ?? '');

            return Str::limit(strip_tags($text), 120);
        };
    }

    public function render()
    {
        $query = DB::table('cases')
            ->when($this->search, function ($q) {
                $q->where(function ($qq) {
                    $qq->where('title_id', 'like', "%{$this->search}%")
                       ->orWhere('title_en', 'like', "%{$this->search}%")
                       ->orWhere('deskripsi_id', 'like', "%{$this->search}%")
                       ->orWhere('deskripsi_en', 'like', "%{$this->search}%")
                       ->orWhere('slug', 'like', "%{$this->search}%")
                       ->orWhere('status', 'like', "%{$this->search}%");
                });
            });

        $this->total = $query->count();

        $cases = $query
            ->orderByDesc('created_at')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();

        return view('livewire.cms.page-index-cases', [
            'cases' => $cases,
            'page' => $this->page,
            'lastPage' => $this->lastPage(),
        ]);
    }
}
