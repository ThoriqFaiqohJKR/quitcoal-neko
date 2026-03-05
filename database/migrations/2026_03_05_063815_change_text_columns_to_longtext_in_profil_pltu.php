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
        Schema::table('profil_pltu', function (Blueprint $table) {
            $table->longText('overview_id')->nullable()->change();
            $table->longText('overview_en')->nullable()->change();
            $table->longText('corporate_id')->nullable()->change();
            $table->longText('corporate_en')->nullable()->change();
            $table->longText('environment_id')->nullable()->change();
            $table->longText('environment_en')->nullable()->change();
            $table->longText('spotlight_id')->nullable()->change();
            $table->longText('spotlight_en')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_pltu', function (Blueprint $table) {
            $table->text('overview_id')->nullable()->change();
            $table->text('overview_en')->nullable()->change();
            $table->text('corporate_id')->nullable()->change();
            $table->text('corporate_en')->nullable()->change();
            $table->text('environment_id')->nullable()->change();
            $table->text('environment_en')->nullable()->change();
            $table->text('spotlight_id')->nullable()->change();
            $table->text('spotlight_en')->nullable()->change();
        });
    }
};
