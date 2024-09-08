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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('staff_schedule_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('persons');
            $table->foreign('staff_schedule_id')->references('id')->on('staff_schedules');
            $table->unique(['staff_schedule_id','date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
