<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->string('dependencia');
            $table->string('id_asignacion');
            $table->string('reporte');
            $table->string('ciudadano');
            $table->string('domicilio');
            $table->string('servicio');
            $table->string('fecha');
            $table->string('usuario');
            $table->string('asignacion');
            $table->string('status');
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
        Schema::dropIfExists('incidents');
    }
}
