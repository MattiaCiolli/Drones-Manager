<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToAddressesPathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses_paths', function (Blueprint $table) {
			$table->foreign('addresses_id')->references('id')->on('addresses');
			$table->foreign('paths_id')->references('id')->on('paths');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses_paths', function (Blueprint $table) {
			$table->dropForeign('addresses_paths_addresses_id_foreign');
			$table->dropForeign('addresses_paths_paths_id_foreign');
        });
    }
}
