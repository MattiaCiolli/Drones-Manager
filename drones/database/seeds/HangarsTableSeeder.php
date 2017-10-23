<?php

use Illuminate\Database\Seeder;

class HangarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('hangars')->insert([
            'address_id' => 5,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

		DB::table('hangars')->insert([
			'address_id' => 1,
			'created_at' => \Carbon\Carbon::Now(),
			'updated_at' => \Carbon\Carbon::Now(),
		]);

		DB::table('hangars')->insert([
			'address_id' => 2,
			'created_at' => \Carbon\Carbon::Now(),
			'updated_at' => \Carbon\Carbon::Now(),
		]);
    }
}
