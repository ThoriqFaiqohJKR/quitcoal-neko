<?php

namespace App\Livewire\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PageProfilPltuIndex extends Component
{
    public $pltu;
    public $namaPltu = '-';
    public $heroImage = 'https://images.unsplash.com/photo-1513828583688-c52646db42da?q=80&w=1800&auto=format&fit=crop';
    public $overviewText;
    public $overviewPlain = '-';
    public $corporateText;
    public $environmentText;
    public $spotlightText;

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

        $isEn = app()->getLocale() === 'en';

        $this->namaPltu = $this->pltu->nama_pltu ?? '-';
        $this->heroImage = $this->pltu->image ?: $this->heroImage;
        $this->overviewText = $isEn ? ($this->pltu->overview_en ?? null) : ($this->pltu->overview_id ?? null);
        $this->corporateText = $isEn ? ($this->pltu->corporate_en ?? null) : ($this->pltu->corporate_id ?? null);
        $this->environmentText = $isEn ? ($this->pltu->environment_en ?? null) : ($this->pltu->environment_id ?? null);
        $this->spotlightText = $isEn ? ($this->pltu->spotlight_en ?? null) : ($this->pltu->spotlight_id ?? null);
        $this->overviewPlain = Str::limit(trim(strip_tags($this->overviewText ?? '')), 220, '...') ?: '-';
    }

    public function render()
    {
        return view('livewire.user.page-profil-pltu-index', [
            'pltu' => $this->pltu
        ]);
    }
}
