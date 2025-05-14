<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_ppids', function (Blueprint $table) {
            // First, drop the old column
            $table->dropColumn('role');

            // Then, add the new foreignId column
            $table->foreignId('role_id')
                ->after('id')
                ->constrained('kedudukan_ppids')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('profil_ppids', function (Blueprint $table) {
            // Drop the foreign key column
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            // Restore the original 'role' column
            $table->string('role');
        });
    }
};
