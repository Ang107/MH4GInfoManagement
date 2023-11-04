<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('areas')->insert(
            [
                ['name' => '--'],
                ['name' => '水'],
                ['name' => '天'],
                ['name' => '蔦'],
                ['name' => '崖'],
                ['name' => '傾'],
                ['name' => '砂'],
                ['name' => '紫'],
                ['name' => '柱'],
                ['name' => '豚'],
                ['name' => '柱'],

            ]
        );
    
    }
}
