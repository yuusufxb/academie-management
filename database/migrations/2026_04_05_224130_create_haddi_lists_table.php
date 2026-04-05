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
        Schema::create('haddi_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gre', 15);
            $table->integer('niv');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps()->nullable();
            $table->string('CD_ETAB', 6)->nullable();
            $table->string('la_com', 28)->nullable();
            $table->string('LA_MIL', 4)->nullable();
            $table->string('LA_PROV', 17)->nullable();
            $table->string('CD_PROV', 3)->nullable();
            $table->integer('cyc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('haddi_lists');
    }
};
