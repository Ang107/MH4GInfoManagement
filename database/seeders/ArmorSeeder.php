<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArmorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('armors')->insert(
            [
                ['name' => 'オリジナルA'],
                ['name' => 'オリジナルB'],
                ['name' => 'オリジナルC'],
                ['name' => 'オリジナルD'],
                ['name' => 'オリジナルE'],
                ['name' => 'ドスA'],
                ['name' => 'ドスB'],
                ['name' => 'ドスC'],
                ['name' => 'ドスD'],
                ['name' => 'ドスE'],
                ['name' => 'トライA'],
                ['name' => 'トライB'],
                ['name' => 'トライC'],
                ['name' => 'トライD'],
                ['name' => 'トライE']
            ]
         );
    }
}
