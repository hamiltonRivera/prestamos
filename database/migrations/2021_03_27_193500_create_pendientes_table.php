<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendientes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_contrato');
            $table->foreignId('contrato_id')
                ->constrained('contratos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('fecha_cuota');
            $table->double('monto', 8, 2);
            $table->string('status', 1)->default('p');
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
        Schema::dropIfExists('pendientes');
    }
}
