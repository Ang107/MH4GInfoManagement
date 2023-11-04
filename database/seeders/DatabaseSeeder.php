<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models;

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
            UserSeeder::class,
            MonsterSeeder::class,
            WeaponSeeder::class,
            AreaSeeder::class,
            ArmorSeeder::class,
            ArmorPortSeeder::class,
            PostSeeder::class,
            BookmarkSeeder::class,
            RoomSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
