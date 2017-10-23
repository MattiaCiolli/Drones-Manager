<?php

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            'currency_id' => 1,
            'value' => 15.5,
            'transport_order_id'=>null,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
