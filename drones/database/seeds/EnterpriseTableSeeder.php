<?php

use Illuminate\Database\Seeder;

class EnterpriseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('enterprise_transports')->insert([
			'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
			'name' => "Pizzera Vesuvio",
		]);
    }
}
