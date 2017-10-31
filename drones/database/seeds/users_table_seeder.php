<?php

use Illuminate\Database\Seeder;

class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "a",
            'email' => "a@a.it",
            'password' => "\$2y$10\$jq.mHLglFPl8xIzqPgTCjeEJCCkrJjvhCDNcRFz6xY341k16WnFFy",
            'remember_token' => "C6ZfVWU9uaMcSZYoZPSuN6uqk9E6tt6q4P92lrZ6DxLRYf8GQfbwuiTcRObK",
            "id_maitre" => "1",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);

        DB::table('users')->insert([
            'name' => "b",
            'email' => "b@b.it",
            'password' => "\$2y$10\$jq.mHLglFPl8xIzqPgTCjeEJCCkrJjvhCDNcRFz6xY341k16WnFFy",
            'remember_token' => "C6ZfVWU9uaMcSZYoZPSuN6uqk9E6tt6q4P92lrZ6DxLRYf8GQfbwuiTcRObK",
            "id_maitre" => "2",
            'created_at' => Carbon\Carbon::Now(),
            'updated_at' => Carbon\Carbon::Now(),
        ]);
    }
}
