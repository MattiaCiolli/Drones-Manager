<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addressdata');
            $table->float('lat');
            $table->float('lon');
            $table->integer('srid');
            $table->timestamps();

            $table->integer('path_id')->unsigned()->index()->nullable();
            $table->foreign('path_id')->references('id')->on('paths');

            $table->integer('ordtrasp_id')->unsigned()->index()->nullable();
            $table->foreign('ordtrasp_id')->references('id')->on('order_transports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
