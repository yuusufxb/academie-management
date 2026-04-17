<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media', function (Blueprint $table) {
            if (!Schema::hasColumn('media', 'idact')) {
                $table->foreignId('idact')->nullable()->after('tof')->constrained('activities')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            if (Schema::hasColumn('media', 'idact')) {
                $table->dropConstrainedForeignId('idact');
            }
        });
    }
};

