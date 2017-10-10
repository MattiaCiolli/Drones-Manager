<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaitreForeignKeyToTransportsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports_orders', function (Blueprint $table) {
			$table->foreign('maitre_id')->references('id')->on('transports_maitres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transports_orders', function (Blueprint $table) {
			$table->dropForeign('transports_orders_maitre_id_foreign');
        });
    }
}
