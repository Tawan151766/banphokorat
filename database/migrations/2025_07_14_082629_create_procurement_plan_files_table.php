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
        Schema::create('procurement_plan_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('procurement_plan_types')->onDelete('cascade');
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
        Schema::dropIfExists('procurement_plan_files');
    }
};
