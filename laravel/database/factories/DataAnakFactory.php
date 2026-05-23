<?php

namespace Database\Factories;

use App\Models\DataAnak;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DataAnak>
 */
class DataAnakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(),
            'nama_anak' => fake()->name(),
            'jenis_kelamin' => 'Laki-laki',
            'umur_bulan' => 12,
            'tinggi_badan' => 80,
            'berat_badan' => 10,
        ];
    }
}
