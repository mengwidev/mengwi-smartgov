<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('ref_banjar', 'banjars');
    }

    public function down(): void
    {
        Schema::rename('banjars', 'ref_banjar');
    }
};
