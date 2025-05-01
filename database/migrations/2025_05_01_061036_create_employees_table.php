<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('banjar_id')->constrained('banjars')->onDelete('cascade');
            $table->foreignId('employment_unit_id')->constrained('employment_units')->onDelete('cascade');
            $table->foreignId('employee_level_id')->constrained('employee_levels')->onDelete('cascade');
            $table->string('photo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
