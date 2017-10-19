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
            'catalog_id' => 4,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "S",
            'type' => "Hot",
            'description' => "Piccolo e caldo",
            'catalog_id' => 1,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "S",
            'type' => "Cold",
            'description' => "Freeedo",
            'catalog_id' => 1,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "M",
            'type' => "Cold",
            'catalog_id' => 4,
            'description' => "Gelato. Ahahaha come no",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "M",
            'type' => "Normal",
            'description' => "Un coso normale",
            'catalog_id' => 2,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "L",
            'type' => "Hot",
            'catalog_id' => 4,
            'description' => "Prodotto bollente, prendere con presine",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('product_descriptions')->insert([
            'size' => "L",
            'type' => "Cold",
            'description' => "Il grande freddo",
            'catalog_id' => 3,
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

    }
}
