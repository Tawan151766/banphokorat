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
        Schema::create('ita_contents', function (Blueprint $table) {
            $table->id();
            $table->string('url', 500);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('evaluation_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('evaluation_id')->references('id')->on('ita_evaluations')->onDelete('cascade');
            $table->index('evaluation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ita_contents');
    }
};
