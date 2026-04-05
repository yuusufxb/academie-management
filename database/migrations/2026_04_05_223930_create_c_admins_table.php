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
        Schema::create('c_admins', function (Blueprint $table) {
            $table->id();
            $table->integer('yr');
            $table->string('mois', 12);
            $table->string('lieu')->nullable();
            $table->date('dte');
            $table->text('rap');
            $table->string('tof')->nullable();
            $table->timestamps()->nullable();
                    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_admins');
    }
};
