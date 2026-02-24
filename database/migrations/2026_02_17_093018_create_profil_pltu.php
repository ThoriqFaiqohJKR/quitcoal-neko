<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profil_pltu', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pltu');
            $table->string('unit')->nullable();
            $table->string('image')->nullable();

            $table->string('teknologi_pembangkit')->nullable();
            $table->string('status')->nullable();

            $table->string('kapasitas')->nullable();
            $table->string('konsumsi_batubara_tahun')->nullable();

            $table->integer('tahun_pembangunan')->nullable();
            $table->integer('beroperasi')->nullable();
            $table->integer('berakhir')->nullable();

            $table->string('mata_uang_nilai_investasi')->nullable();
            $table->string('nilai_investasi')->nullable();

            $table->string('program_pemerintah')->nullable();

            $table->string('lembaga_pemberi_pinjaman')->nullable();
            $table->string('pinjaman')->nullable();

            $table->string('mata_uang_nilai_pinjaman')->nullable();
            $table->string('nilai_pinjaman')->nullable();

            $table->string('pengelolaan_1')->nullable();
            $table->string('pengelolaan_2')->nullable();

            $table->string('pengelola')->nullable();
            $table->string('kontraktor_konstruksi')->nullable();

            $table->string('combustion_technology')->nullable();
            $table->string('coal_type')->nullable();
            $table->string('coal_source')->nullable();
            $table->string('alternate_fuel')->nullable();

            $table->string('captive')->nullable();
            $table->string('captive_industry_use')->nullable();
            $table->string('captive_residential_use')->nullable();

            $table->integer('plant_age_years')->nullable();
            $table->text('reference')->nullable();

            $table->text('overview_id')->nullable();
            $table->text('overview_en')->nullable();

            $table->text('corporate_id')->nullable();
            $table->text('corporate_en')->nullable();

            $table->text('environment_id')->nullable();
            $table->text('environment_en')->nullable();

            $table->text('spotlight_id')->nullable();
            $table->text('spotlight_en')->nullable();

            $table->string('level_2')->nullable();
            $table->string('level_3')->nullable();
            $table->string('level_4')->nullable();
            $table->string('level_5')->nullable();
            $table->string('level_6')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->text('slug')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_pltu');
    }
};
