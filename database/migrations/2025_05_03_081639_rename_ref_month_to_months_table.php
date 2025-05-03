<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('ref_month', 'months');
    }

    public function down(): void
    {
        Schema::rename('months', 'ref_month');
    }
};
