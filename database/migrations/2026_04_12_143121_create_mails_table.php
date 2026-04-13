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
       Schema::create('mails', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('email');
    $table->string('objet');
    $table->text('msg');
    $table->string('ipfrom')->nullable();
    $table->boolean('vu')->default(0);
    $table->integer('gre')->default(1011);
    $table->foreignId('buser')->nullable()->constrained('users')->onDelete('set null');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
