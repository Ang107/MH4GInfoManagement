<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MonsterSeeder::class,
            WeaponSeeder::class,
            AreaSeeder::class,
            ArmorSeeder::class,
            ArmorPortSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            BookmarkSeeder::class,
            RoomSeeder::class,
            RoomUserSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
