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
        Schema::create('itens_compra', function (Blueprint $table) {
        $table->id('cod_item');
        $table->unsignedBigInteger('cod_ingrediente');
        $table->foreign('cod_ingrediente')->references('cod_ingrediente')->on('ingredientes');
        $table->unsignedBigInteger('cod_compra');
        $table->foreign('cod_compra')->references('cod_compra')->on('compras');
        $table->decimal('quantidade', 10, 2);
        $table->decimal('valor_unitario', 10, 2);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_compra');
    }
};
