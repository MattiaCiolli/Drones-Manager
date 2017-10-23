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
            'name' => 'Pingue Supermercati Srl',
            'address_id' => 4,
            'catalog_id'=> 4,
			'hangar_id' => 1,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('transports_enterprises')->insert([
            'name' => 'conad',
            'address_id' => 1,
            'catalog_id'=> 1,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('transports_enterprises')->insert([
            'name' => 'ipercina',
            'address_id' => 2,
            'catalog_id'=> 2,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('transports_enterprises')->insert([
            'name' => 'eurospin',
            'address_id' => 3,
            'catalog_id'=> 3,
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);
    }
}
