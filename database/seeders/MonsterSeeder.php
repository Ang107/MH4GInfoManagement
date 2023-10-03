<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonsterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('monsters')->insert(
            [
                ['name' => 'ラージャン'],
                ['name' => 'イビルジョー'],
                ['name' => 'ジンオウガ'],
                ['name' => 'ジンオウガ亜種'],
                ['name' => 'ディアブロス'],
                ['name' => 'ディアブロス亜種'],
                ['name' => 'ティガレックス'],
                ['name' => 'ティガレックス亜種'],
                ['name' => 'セルレギオス'],
                ['name' => 'ブラキディオス'],
                ['name' => 'ダイミョウザザミ亜種'],
                ['name' => 'ドスランポス'],
                ['name' => 'イャンクック'],
                ['name' => 'イャンクック亜種'],
                ['name' => 'イャンガルルガ'],
                ['name' => 'バサルモス'],
                ['name' => 'バサルモス亜種'],
                ['name' => 'キリン'],
                ['name' => 'キリン亜種'],
                ['name' => 'テオテスカトル'],
                ['name' => 'クシャルダオラ'],
                ['name' => 'オオナズチ'],
                ['name' => 'ゴアマガラ'],
                ['name' => 'シャガルマガラ']
            ]
         );
    }
}
