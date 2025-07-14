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
        Schema::create('laws_regs_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->constrained('laws_regs_types')->onDelete('set null');
            $table->text('section_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laws_regs_sections');
    }
};
