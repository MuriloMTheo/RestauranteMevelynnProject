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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('cod_cliente');
            $table->string('nome');
            $table->string('rg')->nullable();
            $table->string('cpf')->unique();
            $table->date('data_nasc')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('bairro')->nullable();
            $table->unsignedBigInteger('cod_cidade');
            $table->foreign('cod_cidade')->references('cod_cidade')->on('cidades');
            $table->string('cep', 9)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
