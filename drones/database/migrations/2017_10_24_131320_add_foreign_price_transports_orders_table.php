<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignPriceTransportsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports_orders', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->integer('price_id')->unsigned()->nullable();
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('set null');
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
            $table->dropForeign('transports_orders_price_id_foreign');
        });
    }
}
