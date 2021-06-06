<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiadors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')
               ->nullable()
               ->constrained('contratos')
               ->onUpdate('cascade')
               ->onDelete('cascade');
            $table->string('dni', 18)->unique();
            $table->string('nombres_apellidos', 100);
            $table->string('sexo', 1);
            $table->string('departamento');
            $table->string('municipio');
            $table->string('direccion', 150);
            $table->string('telefono', 20);
            $table->string('email', 100);
            $table->date('fecha_nac');
            $table->string('nivel_academico', 50);
            $table->string('profesion', 100);
            $table->string('estado_civil', 1);
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
        Schema::dropIfExists('fiadors');
    }
}
