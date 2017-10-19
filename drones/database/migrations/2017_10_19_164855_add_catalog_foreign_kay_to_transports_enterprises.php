<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCatalogForeignKayToTransportsEnterprises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports_enterprises', function (Blueprint $table) {
            $table->integer('catalog_id')->nullable();
            $table->foreign('catalog_id')->references('id')->on('catalogs');
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
            $table->dropForeign('transports_enterprises_catalog_id_foreign');
        });
    }
}
