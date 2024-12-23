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
        Schema::create('microsite_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('microsite_pages')->cascadeOnDelete()->index();
            $table->string('logo')->nullable();
            $table->string('title');
            $table->string('destination_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('microsite_links');
    }
};
