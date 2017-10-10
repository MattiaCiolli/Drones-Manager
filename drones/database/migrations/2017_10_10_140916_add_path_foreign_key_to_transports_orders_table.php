<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPathForeignKeyToTransportsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports_orders', function (Blueprint $table) {
			$table->foreign('path_id')->references('id')->on('paths')->onDelete('cascade');
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
            $table->dropForeign('transports_orders_path_id_foreign');
        });
    }
}
