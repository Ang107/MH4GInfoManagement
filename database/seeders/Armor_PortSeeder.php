<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Armor_PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('armor_ports')->insert(
            [
                ['name' => '頭'],
                ['name' => '胴'],
                ['name' => '腕'],
                ['name' => '腰'],
                ['name' => '脚']
            ]
         );
    }
}
