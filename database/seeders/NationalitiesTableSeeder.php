<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->delete();
        $now = now();

        $nationalities = [
            [
                "nationality_code" => "ID", 
                "nationality_name" => "Indonesia",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                "nationality_code" => "MY", 
                "nationality_name" => "Malaysia",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                "nationality_code" => "TH", 
                "nationality_name" => "Thailand",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                "nationality_code" => "SG", 
                "nationality_name" => "Singapore",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                "nationality_code" => "VN", 
                "nationality_name" => "Vietnam",
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];
        
		DB::table('nationalities')->insert($nationalities);
    }
}
