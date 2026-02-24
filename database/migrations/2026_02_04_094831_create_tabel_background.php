<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('background', function (Blueprint $table) {
            $table->id();

            $table->longText('title_id')->nullable();
            $table->longText('title_en')->nullable();


            $table->longText('deskripsi_id')->nullable();
            $table->longText('deskripsi_en')->nullable();

            $table->longText('content_id')->nullable();
            $table->longText('content_en')->nullable();

            $table->string('image')->nullable();
            $table->string('image_slug')->nullable();

            $table->date('tanggal')->nullable();
            $table->longText('sumber')->nullable();

            $table->enum('status', ['Y', 'N'])->nullable();

            $table->enum('type', [
                'coalcrowd',
                'coal-permit',
                'regulation',
                'benchmark-price',
                'coal-production',
                'coal-consumption',
                'mining-and-deforestation',
            ])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backgrounds');
    }
};
