<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert(
            [
            'invite_user_id' => '1',
            'invited_user_id' => '2',
            'last_sent_message' => 'ラストメッセージ',
            'last_sent_at' => new DateTime()
            ]
        );
    }
}
