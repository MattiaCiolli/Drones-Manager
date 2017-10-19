<?php

use Illuminate\Database\Seeder;

class PathsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paths')->insert([
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
			'path_geometry' => "0102000020110F00000400000011B99ECB63B13641515A876CBCE653413E8757B9B0AE364118539A0F71E55341916A01BE82B1364118539A0F71E5534111B99ECB63B13641515A876CBCE65341",
			'path_lenght' =>  34.32
        ]);

        DB::table('paths')->insert([
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
			'path_geometry' => "0102000020110F00000400000011B99ECB63B13641515A876CBCE653413E8757B9B0AE364118539A0F71E55341916A01BE82B1364118539A0F71E5534111B99ECB63B13641515A876CBCE65341",
			'path_lenght' =>  34.32
        ]);
    }
}
