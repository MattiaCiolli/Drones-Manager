<?php

use Illuminate\Database\Seeder;

class AddressesPathsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses_paths')->insert([
            'addresses_id' => 1,
            'paths_id' => 1,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('addresses_paths')->insert([
            'addresses_id' => 2,
            'paths_id' => 1,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('addresses_paths')->insert([
            'addresses_id' => 3,
            'paths_id' => 2,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
