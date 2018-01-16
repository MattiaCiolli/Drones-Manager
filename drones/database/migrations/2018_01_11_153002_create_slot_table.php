<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('diary_id');
            $table->integer('index');
            $table->timestamps();

            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('transports_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }
}
