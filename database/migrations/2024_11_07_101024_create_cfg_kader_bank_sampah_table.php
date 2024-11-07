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
        Schema::create('cfg_kader_bank_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('bank_sampah_name');
            $table->integer('kd_count_bt');
            $table->integer('kd_count_gb');
            $table->integer('kd_count_pd');
            $table->integer('kd_count_mg');
            $table->integer('kd_count_pdn');
            $table->integer('kd_count_srg');
            $table->integer('kd_count_prg');
            $table->integer('kd_count_lp');
            $table->integer('kd_count_pg');
            $table->integer('kd_count_al');
            $table->integer('kd_count_dba');
            $table->integer('honor');
            $table->integer('tax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfg_kader_bank_sampah');
    }
};
