<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'address' => "via uruguay",
            'lat' => 41.8919300,
            'lon' => 12.5113300,
            'srid' => 4326,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('addresses')->insert([
            'address' => "via gatti 44",
            'lat' => 42.3505500,
            'lon' => 13.3995400,
            'srid' => 4326,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('addresses')->insert([
            'address' => "via dell'aquila",
            'lat' => 42.2132100,
            'lon' => 13.8251100,
            'srid' => 4326,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);
    }
}
