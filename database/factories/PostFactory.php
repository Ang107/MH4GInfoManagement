<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1, 20),
            'default_level' => fake()->numberBetween(45, 110),
            'left_monster_id' => fake()->numberBetween(2, 24),
            'left_monster_area' => fake()->numberBetween(1, 4),
            'right_monster_id' => fake()->numberBetween(1, 24),
            'right_monster_area' => fake()->numberBetween(1, 4),
            'area_1_id' => fake()->numberBetween(2, 11),
            'area_2_id' => fake()->numberBetween(2, 11),
            'area_3_id' => fake()->numberBetween(2, 11),
            'area_4_id' => fake()->numberBetween(1, 11),
            'treasure_area_number' => fake()->numberBetween(1, 5),
            'weapon_id' => fake()->numberBetween(1, 6),
            'armor_id' => fake()->numberBetween(1, 15),
            'armor_port_id' => fake()->numberBetween(1, 5),
            'generator' => fake()-> firstKanaName(),
            'remark' => fake()-> realText(250,5),
            'created_at' => fake()-> dateTime(),
            'updated_at'=> fake()-> dateTime(),
        ];
    }
}
