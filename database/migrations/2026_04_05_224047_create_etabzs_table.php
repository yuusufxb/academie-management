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
        Schema::create('etabzs', function (Blueprint $table) {
            $table->string('CD_ETAB', 6)->primary();
            $table->string('NOM_ETABA', 60)->nullable();
            $table->integer('cyc')->nullable();
            $table->string('la_com', 28)->nullable();
            $table->string('LA_MIL', 4)->nullable();
            $table->string('CD_PROV', 3)->nullable();
            $table->string('LA_PROV', 17)->nullable();
            $table->index('CD_PROV');
            $table->index('la_com');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etabzs');
    }
};
