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
            'description' => "Prodotto normale, quasi",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "M",
            'type' => "Cold",
            'description' => "Gelato. Ahahaha come no",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "L",
            'type' => "Hot",
            'description' => "Prodotto bollente, prendere con presine",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);


    }
}
