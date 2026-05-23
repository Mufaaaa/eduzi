<?php

namespace Database\Factories;

use App\Models\Komunitas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Komunitas>
 */
class KomunitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'isi' => fake()->paragraph(),
            'guest_identifier' => null,
        ];
    }
}
