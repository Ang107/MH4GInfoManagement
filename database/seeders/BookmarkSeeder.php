<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookmarks')->insert(
            [
                [
                'user_id' => '1',
                'post_id' => '1',
                'added_at' => new DateTime()
                ],
                [
                'user_id' => '2',
                'post_id' => '1',
                'added_at' => new DateTime()
                ]
            ]
        );
    }
}
