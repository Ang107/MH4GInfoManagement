<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('posts')->insert(
            [
            'user_id' => '1',
            'default_level' => '56',
            'right_monster_id' => '1',
            'right_monster_area' => '1',
            'left_monster_id' => '2',
            'left_monster_area' => '3',
            'area_1_id' => '1',
            'area_2_id' => '2',
            'area_3_id' => '4',
            'area_4_id' => '11',
            'treasure_area_number' => '2',
            'weapon_id' => '4',
            'armor_id' => '1',
            'armor_port_id' => '2',
            'generator' => 'Ang',
            'bookmark_number' => '0',
            'remark' => '良いクエストです',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
            ]
         );
    }
}
