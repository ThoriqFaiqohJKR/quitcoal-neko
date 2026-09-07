<?php

namespace Tests\Feature;

use App\Livewire\Cms\PageIndexCheckPltu;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use Tests\TestCase;

class CheckPltuFiltersTest extends TestCase
{
    public function test_search_and_type_filter_reset_pagination_and_combine(): void
    {
        Schema::create('profil_pltu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pltu');
            $table->string('jenis_pltu')->nullable();
            $table->string('level_2')->nullable();
            $table->string('level_6')->nullable();
            $table->string('status')->nullable();
        });

        for ($i = 1; $i <= 25; $i++) {
            DB::table('profil_pltu')->insert([
                'nama_pltu' => sprintf('Alpha %02d', $i),
                'jenis_pltu' => 'captive',
            ]);
        }
        DB::table('profil_pltu')->insert([
            'nama_pltu' => 'Beta Station',
            'jenis_pltu' => 'non captive',
        ]);

        Livewire::test(PageIndexCheckPltu::class)
            ->assertViewHas('profilPltu', fn ($rows) => $rows->count() === 20 && $rows->total() === 26)
            ->call('setPage', 2)
            ->assertViewHas('profilPltu', fn ($rows) => $rows->firstItem() === 21 && $rows->count() === 6)
            ->set('search', 'Beta')
            ->assertViewHas('profilPltu', fn ($rows) => $rows->currentPage() === 1 && $rows->total() === 1)
            ->assertSee('Beta Station')
            ->set('jenisPltu', 'captive')
            ->assertSee('Tidak ada PLTU sesuai pencarian atau filter')
            ->set('search', '')
            ->assertViewHas('profilPltu', fn ($rows) => $rows->total() === 25)
            ->call('setPage', 2)
            ->set('jenisPltu', 'non captive')
            ->assertViewHas('profilPltu', fn ($rows) => $rows->currentPage() === 1 && $rows->total() === 1)
            ->set('jenisPltu', '')
            ->assertViewHas('profilPltu', fn ($rows) => $rows->total() === 26);
    }
}
