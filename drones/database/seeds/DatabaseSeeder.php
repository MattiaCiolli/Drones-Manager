<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(PathsTableSeeder::class);
        $this->call(AddressesPathsTableSeeder::class);
        $this->call(transport_enterpriseTableSeeder::class);
        $this->call(TransportMaitresTableSeeder::class);
        $this->call(ProductsDescriptionsTableSeeder::class);
		$this->call(RegulationUDF::class);
		$this->call(NoFlyZoneTableSeeder::class);
    }
}
