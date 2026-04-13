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
       Schema::create('reports', function (Blueprint $table) {
    $table->id();
    $table->foreignId('idact')->constrained('activities')->onDelete('cascade');
    $table->string('title')->nullable();
    $table->foreignId('byu')->constrained('users')->onDelete('cascade');
    $table->longText('rap');
    $table->integer('vu')->default(0);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
