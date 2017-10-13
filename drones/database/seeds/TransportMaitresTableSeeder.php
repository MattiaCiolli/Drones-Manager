<?php

use Illuminate\Database\Seeder;

class TransportMaitresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transports_maitres')->insert([
            'name' => "Carlo",
            'surname' => "Cracco",
            'enterprise_id' => 1,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('transports_maitres')->insert([
            'name' => "Joe",
            'surname' => "Bastianich ",
            'enterprise_id' => 1,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);
    }
}
