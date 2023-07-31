<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotizacion_id')->nullable();
            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->json('alimentos_ids')->nullable();
            $table->date('fecha_serv');            
            $table->string('cantidad');
            $table->string('precio_unitario');
            $table->string('total');
            $table->string('costo_envio')->nullable();
            // $table->json('huespedes_ids')->nullable();
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
        Schema::dropIfExists('servicios');
    }
}
