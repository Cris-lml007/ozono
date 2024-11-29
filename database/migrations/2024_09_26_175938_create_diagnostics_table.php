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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('history_id');
            // $table->dateTime('date')->useCurrent();
            $table->string('description');
            $table->boolean('status')->default(true);
            $table->string('disease');
            $table->string('consultation');
            $table->string('physicalExam');
            $table->set('body_pain',["cabeza","rostro","cuello","hombro derecho","hombro izquierdo","antebrazo derecho","antebrazo izquierdo","codo derecho","codo izquierdo","mano derecha","manos izquierdas","pecho derecho","pecho izquierdo","costillas izquierdas","costillas derechas","barriga","vientre izquierdo","vientre derecho","muslo derecho","interior del muslo derecho","muslo interno izquierdo","muslo izquierdo","genitales","rodilla derecha","rodilla izquierda","pantorrilla izquierda","pantorrilla derecha","pies derechos","pies izquierdos","cabeza hacia atras","nuca","clavicula izquierda","atras-izquierda","clavicula derecha","atras-derecha","brazo derecho","brazo izquierdo","lomo","columna","nalga","pierna izquierda","pierna derecha"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
