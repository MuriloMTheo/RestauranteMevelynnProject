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
        Schema::create('composicao', function (Blueprint $table) {
            $table->unsignedBigInteger('cod_prato');
            $table->unsignedBigInteger('cod_ingrediente');
            $table->foreign('cod_prato')->references('cod_prato')->on('pratos');
            $table->foreign('cod_ingrediente')->references('cod_ingrediente')->on('ingredientes');
            $table->decimal('quantidade', 10, 2);
            $table->primary(['cod_prato', 'cod_ingrediente']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('composicao');
    }
};
