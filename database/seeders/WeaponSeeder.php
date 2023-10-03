<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('weapons')->insert(
            [
                ['name' => '大剣太刀'],
                ['name' => '片手双剣'],
                ['name' => '槌笛'],
                ['name' => '槍銃槍'],
                ['name' => 'アク棍'],
                ['name' => '弓ボ']
            ]
         );
    }
}
