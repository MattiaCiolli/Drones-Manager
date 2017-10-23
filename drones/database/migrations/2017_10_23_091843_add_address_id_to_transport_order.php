<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressIdToTransportOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports_orders', function (Blueprint $table) {
			$table->integer('address_id')->nullable();
			$table->foreign('address_id')->references('id')->on('addresses');
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
			$table->dropForeign('transports_orders_address_id_foreign');
        });
    }
}
