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
        Schema::create('perf_results_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_topic_id')->nullable()->constrained('perf_results_sub_topics')->onDelete('set null');
            $table->string('files_path');
            $table->string('files_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perf_results_files');
    }
};
