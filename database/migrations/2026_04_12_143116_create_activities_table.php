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
       Schema::create('activities', function (Blueprint $table) {
    $table->id();
    $table->integer('typ');
    $table->date('dte')->default('2022-03-18');
    $table->time('hr');
    $table->string('title');
    $table->string('resp')->nullable();
    $table->string('lieu');
    $table->string('benfs');
    $table->double('nb');
    $table->string('ref');
    $table->string('gre', 15)->index();
    $table->integer('niv');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
