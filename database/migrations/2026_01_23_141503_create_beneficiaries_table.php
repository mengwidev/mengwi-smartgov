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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_induk_kependudukan', 16);
            $table->string('nomor_kk', 16);
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->foreignId('banjar_id')->constrained('banjars')->cascadeOnDelete();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
