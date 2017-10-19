<?php

use Illuminate\Database\Seeder;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogs')->insert([
            'catalog_name' => "Catalogo conad Natale",
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('catalogs')->insert([
            'catalog_name' => "Catalogo ipercina",
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('catalogs')->insert([
            'catalog_name' => "Catalogo eurospin",
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);

        DB::table('catalogs')->insert([
            'catalog_name' => "Catalogo pizzeria fallimentare",
            'created_at' => \Carbon\Carbon::Now(),
            'updated_at' => \Carbon\Carbon::Now(),
        ]);


    }
}
