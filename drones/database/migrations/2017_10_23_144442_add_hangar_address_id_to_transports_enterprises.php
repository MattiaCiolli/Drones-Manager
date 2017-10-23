<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHangarAddressIdToTransportsEnterprises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports_enterprises', function (Blueprint $table) {
			$table->integer('hangar_id')->nullable();
			$table->foreign('hangar_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transports_enterprises', function (Blueprint $table) {
			$table->dropForeign('transports_enterprises_hangar_id_foreign');
        });
    }
}
