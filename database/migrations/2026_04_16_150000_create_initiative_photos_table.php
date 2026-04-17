<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('initiative_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idrep')->constrained('reports')->onDelete('cascade');
            $table->string('name');
            $table->string('path');
            $table->timestamps();

            // If you later want a "main photo", you can add it similarly to activities.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('initiative_photos');
    }
};

