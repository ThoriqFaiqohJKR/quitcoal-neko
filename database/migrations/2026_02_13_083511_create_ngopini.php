<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ngopini', function (Blueprint $table) {
            $table->id();
            $table->string('flayer_id')->nullable();
            $table->string('flayer_en')->nullable();
            $table->string('judul_id')->nullable();
            $table->string('judul_en')->nullable();
            $table->text('deskripsi_id')->nullable();
            $table->text('deskripsi_en')->nullable();
            $table->longText('isi_id')->nullable();
            $table->longText('isi_en')->nullable();
            $table->longText('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ngopini');
    }
};
