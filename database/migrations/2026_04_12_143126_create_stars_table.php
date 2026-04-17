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
        Schema::create('stars', function (Blueprint $table) {
    $table->id();
    $table->foreignId('idact')->nullable()->constrained('activities')->onDelete('cascade'); 
    $table->integer('typ');
    $table->string('title');
    $table->text('infos');
    $table->text('tof')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stars');
    }
};
