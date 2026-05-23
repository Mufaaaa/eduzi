<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KalkulatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_kalkulator_page_can_be_accessed()
    {
        $response = $this->get('/kalkulator');

        $response->assertStatus(200);
    }

    public function test_user_can_predict_stunting()
    {
        Http::fake([
            'http://127.0.0.1:8080/predict' => Http::response([
                'prediction' => 'Normal',
                'penjelasan' => 'Anak dalam kondisi normal',
                'rekomendasi' => 'Tetap jaga pola makan',
                'bmi' => 18.5,
            ], 200),
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/predict', [
            'nama' => 'Budi',
            'jenis_kelamin' => 'Laki-laki',
            'umur_bulan' => 24,
            'tinggi_badan' => 85,
            'berat_badan' => 12,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('data_anak', [
            'nama_anak' => 'Budi',
            'jenis_kelamin' => 'Laki-laki',
        ]);

        $this->assertDatabaseHas('hasil_kalkulator', [
            'hasil_prediksi' => 'Normal',
        ]);
    }

    public function test_predict_validation_required()
    {
        $response = $this->post('/predict', []);

        $response->assertSessionHasErrors([
            'nama',
            'jenis_kelamin',
            'umur_bulan',
            'tinggi_badan',
            'berat_badan',
        ]);
    }
}