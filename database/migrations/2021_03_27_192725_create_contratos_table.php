<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('numero');
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('monto_prestamo', 12, 2);
            $table->float('tasa', 6, 2);
            $table->double('monto_interes', 12, 2);
            $table->float('mto', 6, 2);
            $table->double('mantenimiento', 12, 2);
            $table->double('monto_total', 12, 2);
            $table->string('garantia');
            $table->double('cuotas');
            $table->integer('plazo');
            $table->string('periodo')->default('mensual');
            $table->string('status', 1)->default('v');
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
        Schema::dropIfExists('contratos');
    }
}
