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
        Schema::create('menu_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('title', 255)->nullable();
            $table->string('word_file', 255)->nullable();
            $table->string('excel_file', 255)->nullable();
            $table->string('pdf_file', 255)->nullable();
            $table->string('image_file', 255)->nullable();
            $table->timestamps();
            
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_attachments');
    }
};
