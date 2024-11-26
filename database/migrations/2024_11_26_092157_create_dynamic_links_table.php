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
        Schema::create('dynamic_links', function (Blueprint $table) {
            $table->id();
            $table->string('original_link');
            $table->string('custom_slug');
            $table->string('qr_code_filename')->nullable();
            $table->foreignId('category_id')->constrained('dynamic_link_categories')->cascadeOnDelete();
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_links');
    }
};
