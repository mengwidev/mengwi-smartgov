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
        Schema::create('gov_employee', function (Blueprint $table) {
            $table->id();
            $table->string('att_pin');
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('prefix_title');
            $table->string('suffix_title');
            $table->foreignId('last_education_id')->constrained('ref_last_education')->cascadeOnDelete();
            $table->foreignId('banjar_id')->constrained('ref_banjar')->cascadeOnDelete();
            $table->foreignId('employment_position_id')->constrained('ref_employment_position')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gov_employee');
    }
};
