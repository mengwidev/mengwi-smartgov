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
        Schema::create('public_information_applications', function (Blueprint $table) {
            $table->id();
            $table->string('reg_num')->unique();
            $table->foreignId('application_status_id')->constrained('application_statuses')->cascadeOnDelete();
            $table->foreignId('applicant_id')->constrained('applicants')->cascadeOnDelete();
            $table->foreignId('application_method_id')->constrained('application_methods')->cascadeOnDelete();
            $table->string('information_requested');
            $table->string('information_purposes');
            $table->foreignId('information_receival_id')->constrained('information_receivals')->cascadeOnDelete();
            $table->boolean('is_get_copy')->nullable();
            $table->string('get_copy_method')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('status_updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_information_applications');
    }
};
