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
        Schema::create('perf_results_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->constrained('perf_results_types')->onDelete('set null');
            $table->text('section_name');
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perf_results_sections');
    }
};
