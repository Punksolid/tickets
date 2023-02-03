<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtractConceptos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create conceptos table
        if (!Schema::hasTable('conceptos')) {
            Schema::create('conceptos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('concepto_id')->unsigned();
                $table->string('descripcion');
                $table->string('importe');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('multas_conceptos')) {
            Schema::create('multas_conceptos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('multa_id')->unsigned();
                $table->integer('concept_id')->unsigned();
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // disable constrains
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('multas_conceptos');
        Schema::dropIfExists('conceptos');
        Schema::enableForeignKeyConstraints();
    }
}
