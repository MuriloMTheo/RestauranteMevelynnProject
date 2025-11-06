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
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id('cod_ingrediente');
            $table->string('descricao');
            $table->unsignedBigInteger('cod_unidade');
            $table->foreign('cod_unidade')->references('cod_unidade')->on('unidades');
            $table->boolean('controle_estoque')->default(true);
            $table->decimal('quantidade_estoque', 10, 2)->default(0);
            $table->decimal('valor_unitario', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredientes');
    }
};
