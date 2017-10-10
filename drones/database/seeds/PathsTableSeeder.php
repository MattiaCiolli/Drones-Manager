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
        ]);

        DB::table('paths')->insert([
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);
        
    }
}
