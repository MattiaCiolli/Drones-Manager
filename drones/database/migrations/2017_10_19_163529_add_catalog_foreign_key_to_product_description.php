<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCatalogForeignKeyToProductDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_descriptions', function (Blueprint $table) {
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
        Schema::table('product_descriptions', function (Blueprint $table) {
            $table->dropForeign('product_descriptions_catalog_id_foreign');
        });
    }
}
