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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->integer('ci')->nullable(false);
            $table->string('surname')->nullable(false);
            $table->string('name')->nullable(false);
            $table->date('birthdate')->nullable(false);
            $table->string('allergies')->nullable(true);
            $table->string('surgeries')->nullable(true);
            $table->string('pathological')->nullable(true);
            $table->integer('gender');
            $table->timestamps();
        });

        Schema::table('users',function(Blueprint $table){
            $table->foreign('person_id')->references('id')->on('persons');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
