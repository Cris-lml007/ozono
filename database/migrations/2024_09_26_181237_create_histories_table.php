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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medic_id')->nullable(true)->default(null);
            $table->unsignedBigInteger('nurse_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('reservation_id');
            // $table->unsignedBigInteger('diagnostic_id');
            $table->unsignedBigInteger('detail_diagnostic_id')->nullable(true)->default(null);
            $table->string('description')->nullable(true)->default(null);
            $table->string('presure');
            $table->integer('temperature');
            $table->float('heart_rate');
            $table->float('respiratory_rate');
            $table->float('weight');
            $table->float('height');
            $table->float('canceled');
            $table->timestamps();

            $table->foreign('medic_id')->references('id')->on('persons');
            $table->foreign('nurse_id')->references('id')->on('persons');
            $table->foreign('person_id')->references('id')->on('persons');
            $table->foreign('reservation_id')->references('id')->on('reservations');
            // $table->foreign('diagnostic_id')->references('id')->on('diagnostics');
            $table->foreign('detail_diagnostic_id')->references('id')->on('detail_diagnostics');
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            $table->foreign('history_id')->references('id')->on('histories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
