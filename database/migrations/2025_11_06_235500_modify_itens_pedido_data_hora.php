<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ModifyItensPedidoDataHora extends Migration
{
    /**
     * Run the migrations.
     *
     * We'll alter the `data_hora` column to allow NULL and set a default CURRENT_TIMESTAMP
     * to avoid insert errors when the application doesn't provide the field.
     * Use DB::statement to avoid requiring doctrine/dbal for column change.
     *
     * Note: this migration assumes MySQL. If you use another DB, adjust accordingly.
     */
    public function up()
    {
        // MySQL statement to modify column - make it nullable and default to current timestamp
        DB::statement("ALTER TABLE `itens_pedido` MODIFY `data_hora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP");
    }

    /**
     * Reverse the migrations.
     *
     * We'll remove the DEFAULT CURRENT_TIMESTAMP and keep it nullable to be safe.
     */
    public function down()
    {
        // revert to TIMESTAMP NULL without default
        DB::statement("ALTER TABLE `itens_pedido` MODIFY `data_hora` TIMESTAMP NULL");
    }
}
