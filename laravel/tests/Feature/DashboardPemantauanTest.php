<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardPemantauanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pengguna yang belum login tidak dapat membuka dashboard.
     */
    public function test_pengguna_yang_belum_login_diarahkan_ke_halaman_login(): void
    {
        $response = $this->get(route('pemantauan'));

        $response->assertRedirect('/masuk');
    }

    /**
     * Dashboard dapat dibuka ketika pengguna belum memiliki data anak.
     */
    public function test_dashboard_menampilkan_pesan_jika_belum_ada_data_anak(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('pemantauan'));

        $response->assertOk();
    }

    /**
     * Dashboard menampilkan informasi anak milik pengguna yang login.
     */
    public function test_dashboard_menampilkan_informasi_anak_milik_pengguna(): void
    {
        $user = User::factory()->create();

        DataAnak::create([
            'id_user' => $user->id,
            'nama_anak' => 'Anak Pengujian',
            'jenis_kelamin' => 'Laki-laki',
            'umur_bulan' => 24,
            'tinggi_badan' => 85,
            'berat_badan' => 12,
        ]);

        $response = $this->actingAs($user)
            ->get(route('pemantauan'));

        $response->assertOk()
            ->assertSee('Anak Pengujian');
    }

    /**
     * Dashboard menampilkan status gizi dan detail pemeriksaan terakhir.
     */
    public function test_dashboard_menampilkan_status_gizi_dan_detail_pemeriksaan_terakhir(): void
    {
        $user = User::factory()->create();

        $anak = DataAnak::create([
            'id_user' => $user->id,
            'nama_anak' => 'Anak Sehat',
            'jenis_kelamin' => 'Perempuan',
            'umur_bulan' => 30,
            'tinggi_badan' => 90,
            'berat_badan' => 13,
        ]);

        HasilKalkulator::forceCreate([
            'id_anak' => $anak->id,
            'hasil_prediksi' => 'Normal',
            'penjelasan' => 'Hasil pengujian status gizi anak.',
            'rekomendasi' => 'Berikan makanan bergizi seimbang.',
            'bmi' => 16.0,
        ]);

        $response = $this->actingAs($user)
            ->get(route('pemantauan'));

        $response->assertOk()
            ->assertSee('Anak Sehat')
            ->assertSee('Normal')
            ->assertSee('Hasil pengujian status gizi anak.');
    }

    /**
     * Dashboard tidak menampilkan data anak milik pengguna lain.
     */
    public function test_dashboard_tidak_menampilkan_data_anak_milik_pengguna_lain(): void
    {
        $user = User::factory()->create();
        $userLain = User::factory()->create();

        DataAnak::create([
            'id_user' => $userLain->id,
            'nama_anak' => 'Anak Pengguna Lain',
            'jenis_kelamin' => 'Laki-laki',
            'umur_bulan' => 18,
            'tinggi_badan' => 80,
            'berat_badan' => 10,
        ]);

        $response = $this->actingAs($user)
            ->get(route('pemantauan'));

        $response->assertOk()
            ->assertDontSee('Anak Pengguna Lain');
    }
}
