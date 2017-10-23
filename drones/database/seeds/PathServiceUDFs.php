<?php

use Illuminate\Database\Seeder;

class PathServiceUDFs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::raw("
			CREATE OR REPLACE FUNCTION generatePath(lat1 float, lon1 float, lat2 float, lon2 float, lat3 float, lon3 float) RETURNS geometry LANGUAGE plpgsql AS $$
				DECLARE
					pointA	GEOMETRY;
					pointB	GEOMETRY;
					pointC	GEOMETRY;
					finalPath GEOMETRY;
				BEGIN
					SELECT st_transform(st_setsrid(st_point(lon1, lat1), 4326), 3857) INTO pointA;
					SELECT st_transform(st_setsrid(st_point(lon2, lat2), 4326), 3857) INTO pointB;
					SELECT st_transform(st_setsrid(st_point(lon3, lat3), 4326), 3857) INTO pointC;

					RETURN st_makeLine(ARRAY[pointA, pointB, pointC, pointA]) INTO finalPath;
				END;
			$$");
	}
}
