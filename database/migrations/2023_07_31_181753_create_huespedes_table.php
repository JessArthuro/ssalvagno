<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHuespedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huespedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_h')->nullable();
            $table->string('desayunos')->nullable();
            $table->string('comidas')->nullable();
            $table->string('cenas')->nullable();
            $table->unsignedBigInteger('embarcacion_id')->nullable();
            $table->foreign('embarcacion_id')->references('id')->on('embarcaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('huespedes');
    }
}
