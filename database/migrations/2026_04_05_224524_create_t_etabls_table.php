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
        Schema::create('t_etabls', function (Blueprint $table) {
            $table->string('CD_ETAB', 6);
            $table->string('NOM_ETABA', 60)->nullable();
            $table->string('CD_COM', 7)->nullable();
            $table->string('typeEtab', 6)->nullable();
            $table->string('CD_EtabMere', 6)->nullable();
            $table->integer('cyc')->nullable();
            $table->integer('prov');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_etabls');
    }
};
