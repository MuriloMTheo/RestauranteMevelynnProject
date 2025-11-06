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
        Schema::create('itens_pedido', function (Blueprint $table) {
        $table->id('cod_item');
        $table->unsignedBigInteger('cod_pedido');
        $table->foreign('cod_pedido')->references('cod_pedido')->on('pedidos');
        $table->unsignedBigInteger('cod_prato');
        $table->foreign('cod_prato')->references('cod_prato')->on('pratos');
        $table->integer('quantidade');
        $table->decimal('valor_unitario', 10, 2);
        $table->unsignedBigInteger('cod_garcom')->nullable();
        $table->foreign('cod_garcom')->references('cod_garcom')->on('garcons');
        $table->dateTime('data_hora');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_pedido');
    }
};
