<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('ref_employment_units', 'employment_units');
    }

    public function down(): void
    {
        Schema::rename('employment_units', 'ref_employment_units');
    }
};
