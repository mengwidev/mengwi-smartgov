<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('banjars', function (Blueprint $table) {
            $table->renameColumn('banjar_name', 'name');
        });

        Schema::table('banjars', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    public function down(): void
    {
        Schema::table('banjars', function (Blueprint $table) {
            $table->dropUnique(['name']);
            $table->renameColumn('name', 'banjar_name');
        });
    }
};
