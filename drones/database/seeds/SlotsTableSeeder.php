<?php

use Illuminate\Database\Seeder;

class SlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($j = 1; $j < 8; $j++) {
            for ($i = 0; $i < 96; $i++) {
                DB::table('slots')->insert([
                    'state' => 'free',
                    'diary_id' => $j,
                    'index'=> $i,
                    'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
