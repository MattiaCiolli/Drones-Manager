<?php

use Illuminate\Database\Seeder;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert([
            'type' => 'drone',
            'maxFreeConsSlots'=>96,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('resources')->insert([
            'type' => 'pilot',
            'maxFreeConsSlots'=>96,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('resources')->insert([
            'type' => 'technician',
            'maxFreeConsSlots'=>96,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('resources')->insert([
            'type' => 'drone',
            'maxFreeConsSlots'=>96,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('resources')->insert([
            'type' => 'pilot',
            'maxFreeConsSlots'=>96,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('resources')->insert([
            'type' => 'technician',
            'maxFreeConsSlots'=>96,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('resources')->insert([
            'type' => 'drone',
            'maxFreeConsSlots'=>96,
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
