<?php

namespace Database\Factories;

use App\Models\HasilKalkulator;
use App\Models\DataAnak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HasilKalkulator>
 */
class HasilKalkulatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_anak' => DataAnak::factory(),
            'hasil_prediksi' => 'Normal',
            'penjelasan' => fake()->paragraph(),
            'rekomendasi' => fake()->paragraph(),
        ];
    }
}
