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
        Schema::create('prg_acts', function (Blueprint $table) {
            $table->id();
            $table->string('resp');
            $table->string('title');
            $table->text('result');
            $table->string('src')->default('Aref SH');
            $table->integer('type');
            $table->integer('nbpart')->default(1);
            $table->text('parts')->nullable();
            $table->date('dte');
            $table->text('desc');
            $table->string('lieu');
            $table->integer('vld')->default(0);
            $table->integer('gre')->default(0);
            $table->integer('niv')->default(1);
            $table->timestamps()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prg_acts');
    }
};
