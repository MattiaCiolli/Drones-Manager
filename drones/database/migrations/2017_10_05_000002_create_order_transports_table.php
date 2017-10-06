<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('enttransport_id')->unsigned()->index()->nullable();
            $table->foreign('enttransport_id')->references('id')->on('enterprise_transports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_transports');
    }
}
