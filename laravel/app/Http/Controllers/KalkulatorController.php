<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class KalkulatorController extends Controller
{
    public function index()
    {
        return view('kalkulator');
    }

    public function predict(Request $request)
    {
        // =========================================
        // VALIDASI INPUT
        // =========================================

        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'umur_bulan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:1',
            'berat_badan' => 'required|numeric|min:1',
        ], [
            'nama.required' => 'Nama anak wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'umur_bulan.required' => 'Usia wajib diisi',
            'tinggi_badan.required' => 'Tinggi badan wajib diisi',
            'berat_badan.required' => 'Berat badan wajib diisi',
        ]);

        // =========================================
        // SIMPAN DATA ANAK
        // =========================================

        $anak = DataAnak::create([
            'id_user' => Auth::check() ? Auth::id() : null,

            'nama_anak' => $request->nama,

            'jenis_kelamin' => $request->jenis_kelamin,

            'umur_bulan' => (int) $request->umur_bulan,

            'tinggi_badan' => (float) $request->tinggi_badan,

            'berat_badan' => (float) $request->berat_badan,
        ]);

        // =========================================
        // KIRIM KE FASTAPI
        // =========================================

        $response = Http::timeout(30)->post(
            'http://127.0.0.1:8080/predict',
            [
                'jenis_kelamin' => $request->jenis_kelamin,

                'umur_bulan' => (int) $request->umur_bulan,

                'tinggi_badan' => (float) $request->tinggi_badan,

                'berat_badan' => (float) $request->berat_badan,
            ]
        );

        $hasil = $response->json();

        // =========================================
        // SIMPAN HASIL KALKULATOR
        // =========================================

        HasilKalkulator::create([
            'id_anak' => $anak->id,

            'hasil_prediksi' => $hasil['prediction'],

            'penjelasan' => $hasil['penjelasan'],

            'rekomendasi' => $hasil['rekomendasi'],

            'bmi' => $hasil['bmi'],
        ]);

        // =========================================
        // RETURN VIEW
        // =========================================

        return view('kalkulator', compact('hasil'));
    }
}