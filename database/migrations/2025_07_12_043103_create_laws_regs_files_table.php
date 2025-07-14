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
        Schema::create('laws_regs_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->constrained('laws_regs_sections')->onDelete('set null');
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
        Schema::dropIfExists('laws_regs_files');
    }
};
