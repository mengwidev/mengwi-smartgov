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
            $table->string('prefix_title')->nullable();
            $table->string('suffix_title')->nullable();
            $table->string('tipe_sk')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->string('tahun_sk')->nullable();
            $table->date('sk_ditetapkan_pada')->nullable();
            $table->date('mulai_menjabat')->nullable();
            $table->date('akhir_menjabat')->nullable();
            $table->string('birthplace');
            $table->date('birthdate');
            $table->foreignId('banjar_id')->constrained('banjars')->onDelete('cascade');
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade');
            $table->foreignId('last_education_id')->constrained('last_educations')->onDelete('cascade');
            $table->foreignId('religion_id')->constrained('religions')->onDelete('cascade');
            $table->foreignId('occupation_id')->constrained('occupations')->onDelete('cascade');
            $table->foreignId('marital_status_id')->constrained('marital_statuses')->onDelete('cascade');
            $table->foreignId('employment_unit_id')->constrained('employment_units')->onDelete('cascade');
            $table->foreignId('employee_level_id')->constrained('employee_levels')->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
