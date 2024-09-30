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
        Schema::create('technology_work', function (Blueprint $table) {
          $table->unsignedBigInteger('work_id');
          $table->foreign('work_id')->references('id')->on('works')->cascadeOnDelete();

          $table->unsignedBigInteger('technology_id');
          $table->foreign('technology_id')->references('id')->on('technologies')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_technology');
    }
};