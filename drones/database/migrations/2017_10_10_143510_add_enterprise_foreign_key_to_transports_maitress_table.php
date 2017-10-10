<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnterpriseForeignKeyToTransportsMaitressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports_maitres', function (Blueprint $table) {
			$table->foreign('enterprise_id')->references('id')->on('transports_enterprises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transports_maitres', function (Blueprint $table) {
			$table->dropForeign('transports_maitres_enterprise_id_foreign');
        });
    }
}
