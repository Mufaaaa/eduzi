<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GrafikPerkembanganGiziTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Membuat pengguna untuk pengujian.
     */
    private function buatUser(): User
    {
        return User::factory()->create();
    }

    /**
     * Membuat data anak milik pengguna.
     */
    private function buatAnak(User $user): DataAnak
    {
        return DataAnak::create([
            'id_user' => $user->id,
            'nama_anak' => 'Anak Pengujian',
            'jenis_kelamin' => 'Laki-laki',
            'umur_bulan' => 24,
            'tinggi_badan' => 85,
            'berat_badan' => 12,
        ]);
    }

    /**
     * Membuat hasil kalkulator untuk data anak.
     */
    private function buatHasil(
        DataAnak $anak,
        string $status = 'Normal',
        float $bmi = 16.5
    ): HasilKalkulator {
        return HasilKalkulator::forceCreate([
            'id_anak' => $anak->id,
            'hasil_prediksi' => $status,
            'penjelasan' => 'Penjelasan hasil pemeriksaan.',
            'rekomendasi' => 'Rekomendasi pemenuhan gizi anak.',
            'bmi' => $bmi,
        ]);
    }

    /**
     * Membentuk URL halaman grafik berdasarkan route aplikasi.
     */
    private function urlGrafik(DataAnak $anak): string
    {
        return route('grafik.perkembangan', [
            'anak' => $anak->id,
        ]);
    }

    /**
     * Pengguna yang belum login tidak dapat membuka halaman grafik.
     */
    public function test_pengguna_belum_login_diarahkan_ke_halaman_masuk(): void
    {
        $user = $this->buatUser();
        $anak = $this->buatAnak($user);

        $response = $this->get($this->urlGrafik($anak));

        $response->assertRedirect('/masuk');
    }

    /**
     * Halaman grafik dapat ditampilkan oleh pengguna yang sudah login.
     */
    public function test_halaman_grafik_dapat_dibuka_pengguna_login(): void
    {
        $user = $this->buatUser();
        $anak = $this->buatAnak($user);

        $response = $this->actingAs($user)
            ->get($this->urlGrafik($anak));

        $response->assertOk();
    }

    /**
     * Halaman menampilkan informasi anak yang dipilih.
     */
    public function test_halaman_grafik_menampilkan_informasi_anak(): void
    {
        $user = $this->buatUser();
        $anak = $this->buatAnak($user);

        $response = $this->actingAs($user)
            ->get($this->urlGrafik($anak));

        $response->assertOk();
        $response->assertSee('Anak Pengujian');
        $response->assertSee('Laki-laki');
        $response->assertSee('24');
    }

    /**
     * Halaman menampilkan elemen grafik berat dan tinggi badan.
     */
    public function test_halaman_grafik_menampilkan_canvas_grafik(): void
    {
        $user = $this->buatUser();
        $anak = $this->buatAnak($user);

        $response = $this->actingAs($user)
            ->get($this->urlGrafik($anak));

        $response->assertOk();
        $response->assertSee('grafikBerat');
        $response->assertSee('grafikTinggi');
    }

    /**
     * Halaman menampilkan riwayat pemeriksaan anak.
     */
    public function test_halaman_grafik_menampilkan_riwayat_pemeriksaan(): void
    {
        $user = $this->buatUser();
        $anak = $this->buatAnak($user);

        $this->buatHasil($anak, 'Normal', 16.5);

        $response = $this->actingAs($user)
            ->get($this->urlGrafik($anak));

        $response->assertOk();
        $response->assertSee('Normal');
        $response->assertSee('16.5');
    }

    /**
     * Halaman menampilkan pesan ketika belum ada riwayat pemeriksaan.
     */
    public function test_halaman_grafik_menampilkan_pesan_jika_riwayat_kosong(): void
    {
        $user = $this->buatUser();
        $anak = $this->buatAnak($user);

        $response = $this->actingAs($user)
            ->get($this->urlGrafik($anak));

        $response->assertOk();
        $response->assertSee('Belum ada riwayat pemeriksaan.');
    }

}
