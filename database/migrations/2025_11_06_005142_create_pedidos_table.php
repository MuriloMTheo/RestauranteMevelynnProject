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
        Schema::create('pedidos', function (Blueprint $table) {
        $table->id('cod_pedido');
        $table->dateTime('datahora');
        $table->unsignedBigInteger('cod_cliente');
        $table->foreign('cod_cliente')->references('cod_cliente')->on('clientes');
        $table->string('tipo_pedido', 20);
        $table->unsignedBigInteger('cod_entregador')->nullable();
        $table->foreign('cod_entregador')->references('cod_entregador')->on('entregadores');
        $table->decimal('valor_entrega', 10, 2)->nullable();
        $table->unsignedBigInteger('cod_mesa')->nullable();
        $table->foreign('cod_mesa')->references('cod_mesa')->on('mesas');
        $table->boolean('encerrado')->default(false);
        $table->dateTime('datahora_encerramento')->nullable();
        $table->decimal('desconto', 10, 2)->default(0);
        $table->boolean('pago')->default(false);
        $table->date('data_pago')->nullable();
        $table->decimal('valor_pago', 10, 2)->nullable();
        $table->decimal('taxa_servico', 10, 2)->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
