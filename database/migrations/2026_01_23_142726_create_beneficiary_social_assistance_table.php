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
        Schema::create('beneficiary_assistance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->constrained()->cascadeOnDelete();
            $table->foreignId('social_assistance_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(
                ['beneficiary_id', 'social_assistance_id'],
                'ba_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiary_assistance');
    }
};
