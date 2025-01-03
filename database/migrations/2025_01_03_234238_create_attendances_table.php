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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('att_helper_identification');
            $table->foreignId('employee_id')->constrained('gov_employee')->cascadeOnDelete();
            $table->dateTime('scan_date', precision: 0);
            $table->foreignId('month_id')->constrained('ref_month')->cascadeOnDelete();
            $table->foreignId('att_type_id')->constrained('ref_att_type')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
