<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Boards;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boards>
 */
class BoardsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Work Projects','Personal Life','School Tasks','Travel Plans']),
            'color' => fake()->randomElement(['#f87575','#00b4d8','#80ffdb','#ffee99','#e7c6ff']),
            'discription' => fake()->sentence(),
            'user_id'=>User::inRandomOrder()->first()->id,
            ]; 
    }
}
