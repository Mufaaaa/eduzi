<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KalkulatorUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menguji relasi DataAnak ke User.
     */
    public function test_data_anak_belongs_to_user()
    {
        $user = User::factory()->create();

        $anak = DataAnak::create([
            'id_user' => $user->id,
            'nama_anak' => 'Budi',
            'jenis_kelamin' => 'Laki-laki',
            'umur_bulan' => 24,
            'tinggi_badan' => 85,
            'berat_badan' => 12,
        ]);

        $this->assertInstanceOf(
            User::class,
            $anak->user
        );

        $this->assertEquals(
            $user->id,
            $anak->user->id
        );
    }

    /**
     * Menguji relasi DataAnak memiliki satu HasilKalkulator.
     */
    public function test_data_anak_has_hasil_kalkulator()
    {
        $anak = DataAnak::factory()->create();

        $hasil = HasilKalkulator::create([
            'id_anak' => $anak->id,
            'hasil_prediksi' => 'Normal',
            'penjelasan' => 'Normal',
            'rekomendasi' => 'Pertahankan pola makan',
            'bmi' => 18.5,
        ]);

        $this->assertInstanceOf(
            HasilKalkulator::class,
            $anak->hasilKalkulator
        );

        $this->assertEquals(
            $hasil->id,
            $anak->hasilKalkulator->id
        );
    }

    /**
     * Menguji relasi HasilKalkulator ke DataAnak.
     */
    public function test_hasil_kalkulator_belongs_to_data_anak()
    {
        $anak = DataAnak::factory()->create();

        $hasil = HasilKalkulator::create([
            'id_anak' => $anak->id,
            'hasil_prediksi' => 'Normal',
            'penjelasan' => 'Normal',
            'rekomendasi' => 'Pertahankan pola makan',
            'bmi' => 18.5,
        ]);

        $this->assertInstanceOf(
            DataAnak::class,
            $hasil->dataAnak
        );

        $this->assertEquals(
            $anak->id,
            $hasil->dataAnak->id
        );
    }

    /**
     * Menguji atribut fillable DataAnak.
     */
    public function test_data_anak_fillable_attributes()
    {
        $anak = new DataAnak();

        $expected = [
            'id_user',
            'nama_anak',
            'jenis_kelamin',
            'umur_bulan',
            'tinggi_badan',
            'berat_badan',
        ];

        $this->assertEquals(
            $expected,
            $anak->getFillable()
        );
    }

    /**
     * Menguji atribut fillable HasilKalkulator.
     */
    public function test_hasil_kalkulator_fillable_attributes()
    {
        $hasil = new HasilKalkulator();

        $expected = [
            'id_anak',
            'hasil_prediksi',
            'penjelasan',
            'rekomendasi',
            'bmi',
        ];

        $this->assertEquals(
            $expected,
            $hasil->getFillable()
        );
    }

    /**
     * Menguji perhitungan BMI.
     */
    public function test_bmi_calculation()
    {
        $berat = 12;
        $tinggi = 85;

        $bmi = $berat / pow($tinggi / 100, 2);

        $this->assertGreaterThan(
            0,
            $bmi
        );

        $this->assertEqualsWithDelta(
            16.61,
            $bmi,
            0.1
        );
    }
}