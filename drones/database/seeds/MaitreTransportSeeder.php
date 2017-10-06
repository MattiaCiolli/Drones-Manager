<?php

use Illuminate\Database\Seeder;

class MaitreTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maitre_transports')->insert([
            'name' => 'MarioR',
            'surname' => 'Rossi',
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'enterprisetrasp_id' => 1
        ]);
    }
}
