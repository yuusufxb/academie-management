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
        Schema::create('z_prov', function (Blueprint $table) {
    $table->string('CD_PROV', 15)->primary();
    $table->string('CD_REG', 50)->nullable();
    $table->string('LL_PROV', 50)->nullable();
    $table->string('LA_PROV', 50)->nullable();
    $table->smallInteger('Actif')->nullable();
    $table->dateTime('DateModification')->nullable();
    // No timestamps in your SQL
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('z_provs');
    }
};
