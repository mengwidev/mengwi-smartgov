<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('ref_last_education', 'last_educations');
    }

    public function down(): void
    {
        Schema::rename('last_educations', 'ref_last_education');
    }
};
