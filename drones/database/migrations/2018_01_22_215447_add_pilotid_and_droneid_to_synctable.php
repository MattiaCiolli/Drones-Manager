<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPilotidAndDroneidToSynctable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sync_tables', function (Blueprint $table) {
            $table->integer('findDronIndex')->nullable();;
            $table->integer('findPilotIndex')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sync_tables', function (Blueprint $table) {
            //
        });
    }
}
