<?php

use Illuminate\Support\Facades\Schema;
use Phaza\LaravelPostgis\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoFlyZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('no_fly_zones', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('z_order');
			$table->float('area');
			$table->polygon('building', 'GEOMETRY', 3857); // GEOMETRY POLYGON column with SRID of 27700.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('no_fly_zones');
    }
}
