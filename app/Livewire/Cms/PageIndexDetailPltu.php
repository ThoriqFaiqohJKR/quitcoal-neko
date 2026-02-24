<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PageIndexDetailPltu extends Component
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
        $this->page = max(1, min($page, $this->lastPage()));
    }

    public function prevPage()
    {
        $this->goToPage($this->page - 1);
    }

    public function nextPage()
    {
        $this->goToPage($this->page + 1);
    }

    public function delete($id)
    {
        DB::table('detail_pltu')->where('id', $id)->delete();

        if ($this->page > $this->lastPage()) {
            $this->page = $this->lastPage();
        }

        session()->flash('success', 'Detail PLTU berhasil dihapus');
    }

    public function getDetail()
    {
        $query = DB::table('detail_pltu')
            ->leftJoin('profil_pltu', 'detail_pltu.id_pltu', '=', 'profil_pltu.id')
            ->select('detail_pltu.*', 'profil_pltu.nama as nama_pltu')
            ->orderBy('detail_pltu.created_at', 'desc');

        $this->total = $query->count();

        return $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.cms.page-index-detail-pltu', [
            'detail'   => $this->getDetail(),
            'page'     => $this->page,
            'lastPage' => $this->lastPage(),
            'total'    => $this->total,
            'perPage'  => $this->perPage,
        ]);
    }
}
