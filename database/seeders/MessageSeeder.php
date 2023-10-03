<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert(
            [
                [
                'user_id' => '1',
                'room_id' => '1',
                'body' => 'こんにちは。このギルクエくれませんか',
                'sent_at' => new DateTime()
                ],
                [
                'user_id' => '2',
                'room_id' => '1',
                'body' => 'いいですよ',
                'sent_at' => new DateTime()
                ]
            ]
        );
    }
}
