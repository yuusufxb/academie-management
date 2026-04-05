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
        Schema::create('qossassas', function (Blueprint $table) {
            $table->id();
            $table->string('journal');
            $table->date('dte');
            $table->string('titre');
            $table->string('lien');
            $table->string('photo')->nullable();
            $table->text('txt')->nullable();
            $table->timestamps()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qossassas');
    }
};
