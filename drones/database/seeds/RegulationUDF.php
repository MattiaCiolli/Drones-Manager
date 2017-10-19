<?php

use Illuminate\Database\Seeder;

class RegulationUDF extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::raw("
			CREATE OR REPLACE FUNCTION checkAddressCoordinates(lat float, lon float) RETURNS boolean LANGUAGE plpgsql AS $$
			DECLARE
    			addressPoint GEOMETRY;
        		noFlyZone Record;
        		isOk boolean;
    		BEGIN
    			SELECT st_transform(st_setsrid(st_point(lon, lat), 4326), 3857) INTO addressPoint;
        		isOk = true;
        		FOR noFlyZone IN (SELECT * FROM no_fly_zones) LOOP
					IF st_intersects(noFlyZone.building, addressPoint) THEN
            			isOK = false;
					END IF;
				END LOOP;
        		return isOK;
    		END;
			$$");
    }
}
