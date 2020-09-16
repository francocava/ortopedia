<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clie_id');
            $table->foreignId('suc_id');
            $table->foreignId('estado_id');
            $table->foreignId('usuario_id');
            $table->date('fecha_ingreso_autorizacion');
            $table->bigInteger('nro_autorizacion');
            $table->date('fecha_retiro');
            $table->float('importe_fac');
            $table->string('fl/ct');
            $table->bigInteger('nro_recibo_proveedor');
            $table->boolean('cancelado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('clie_id')
                ->references('id')->on('clientes')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('suc_id')
                ->references('id')->on('sucursales')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('estado_id')
                ->references('id')->on('estados')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}