<?php

use Illuminate\Database\Seeder;

class transport_enterpriseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transports_enterprises')->insert([
            'name' => 'pizzeria polsinelli',
            'address_id' => 4,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);
    }
}
