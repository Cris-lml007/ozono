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
        Schema::create('detail_treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatment_id')->nullable(false);
            $table->unsignedBigInteger('observation_id')->nullable(false);
            $table->foreign('treatment_id')->references('id')->on('treatments')->cascadeOnDelete();
            $table->foreign('observation_id')->references('id')->on('observations')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_treatments');
    }
};
