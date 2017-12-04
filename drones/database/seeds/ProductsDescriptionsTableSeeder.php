<?php

use Illuminate\Database\Seeder;

class ProductsDescriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_descriptions')->insert([
            'size' => "S",
            'type' => "Normal",
            'description' => "E-reader Kindle Paperwhite, schermo da 6'' ad alta risoluzione",
            'catalog_id' => 4,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
            'price' => 53.00,
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "S",
            'type' => "Hot",
            'description' => "Pizzetta calda al pomodoro",
            'catalog_id' => 1,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
            'price' => 1.50,
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "S",
            'type' => "Cold",
            'description' => "Vaccino antinfluenzale",
            'catalog_id' => 1,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
            'price' =>15,
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "M",
            'type' => "Cold",
            'catalog_id' => 4,
            'description' => "Carne surgelata, confezione famiglia",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
            'price' => 9.50,
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "M",
            'type' => "Normal",
            'description' => "Portatile 13'' Acer",
            'catalog_id' => 2,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
            'price' => 400.00,
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "L",
            'type' => "Hot",
            'catalog_id' => 4,
            'description' => "Tacchino arrosto 7kg con patate al forno",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
            'price' => 35.00,
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "L",
            'type' => "Cold",
            'description' => "Damigiana 5lt Montepulpiano",
            'catalog_id' => 3,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
            'price' => 12.70,
        ]);

    }
}
