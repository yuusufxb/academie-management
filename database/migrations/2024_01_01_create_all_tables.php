<?php
// database/migrations/2024_01_01_000001_create_activities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');                   // احتفال | ورشة | مسابقة | ...
            $table->date('date');
            $table->string('place');
            $table->string('responsible');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();        // emoji or material icon name
            $table->string('color_class')->nullable(); // Tailwind gradient classes
            $table->string('type_color')->nullable();  // badge bg color class
            $table->string('status')->default('مسودة'); // مصادق | انتظار | مسودة
            $table->date('scheduled_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->boolean('watermarked')->default(false);
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('platform');   // YouTube | Facebook
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('press_clippings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('source');
            $table->string('url')->nullable();
            $table->date('published_at');
            $table->timestamps();
        });

        Schema::create('council_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_month');   // دجنبر
            $table->year('year');
            $table->date('date');
            $table->string('place');
            $table->text('summary')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps();
        });

        Schema::create('initiatives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('level');   // محلي | جهوي
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('magazine_editions', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('month');
            $table->year('year');
            $table->string('path')->nullable();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_email')->nullable();
            $table->string('subject');
            $table->text('body');
            $table->boolean('is_read')->default(false);
            $table->string('status')->default('جديد');   // جديد | مسجل | مغلق
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Schema::dropIfExists('messages');
        // Schema::dropIfExists('magazine_editions');
        // Schema::dropIfExists('initiatives');
        // Schema::dropIfExists('council_sessions');
        // Schema::dropIfExists('press_clippings');
        // Schema::dropIfExists('videos');
        // Schema::dropIfExists('photos');
        // Schema::dropIfExists('activities');
    }
};
