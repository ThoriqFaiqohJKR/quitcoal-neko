<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('title_id')->nullable();
            $table->string('title_en')->nullable();
            $table->longText('deskripsi_id')->nullable();
            $table->longText('deskripsi_en')->nullable();
            $table->string('image')->nullable();
            $table->string('image_slug')->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('status', ['Y', 'N'])->nullable();
            $table->string('slug')->nullable();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
