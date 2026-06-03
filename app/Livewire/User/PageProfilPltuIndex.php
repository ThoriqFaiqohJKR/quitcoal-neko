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
    public $locale = 'id';

    public function mount()
    {
        $this->locale = app()->getLocale();
        $id = request()->query('id');

        $query = DB::table('profil_pltu');
        if ($id) {
            $query->where('id', $id);
        }

        $this->pltu = $query->first();

        if (!$this->pltu) {
            $this->pltu = DB::table('profil_pltu')->orderBy('id')->first();
        }

        $this->namaPltu = $this->pltu->nama_pltu ?? '-';
        $this->heroImage = $this->pltu->image ?: $this->heroImage;
        $this->overviewText = $this->localizedContent($this->pltu->overview_id ?? null, $this->pltu->overview_en ?? null);
        $this->corporateText = $this->localizedContent($this->pltu->corporate_id ?? null, $this->pltu->corporate_en ?? null);
        $this->environmentText = $this->localizedContent($this->pltu->environment_id ?? null, $this->pltu->environment_en ?? null);
        $this->spotlightText = $this->localizedContent($this->pltu->spotlight_id ?? null, $this->pltu->spotlight_en ?? null);
        $this->overviewPlain = Str::limit(trim(strip_tags($this->overviewText ?? '')), 220, '...') ?: '-';
    }

    private function localizedContent(?string $idContent, ?string $enContent): ?string
    {
        $preferred = $this->locale === 'en' ? $enContent : $idContent;

        return $this->hasContent($preferred) ? $preferred : null;
    }

    private function hasContent(?string $content): bool
    {
        return trim(strip_tags($content ?? '')) !== '';
    }

    public function render()
    {
        return view('livewire.user.page-profil-pltu-index', [
            'pltu' => $this->pltu,
            'overviewText' => $this->overviewText,
            'corporateText' => $this->corporateText,
            'environmentText' => $this->environmentText,
            'spotlightText' => $this->spotlightText,
            'locale' => $this->locale,
        ]);
    }
}
