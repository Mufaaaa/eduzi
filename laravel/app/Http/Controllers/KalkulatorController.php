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
        // Simpan data anak dulu
        $anak = DataAnak::create([
            'id_user' => Auth::check() ? Auth::id() : null,

            'nama_anak' => $request->nama,

            'jenis_kelamin' => $request->jenis_kelamin,

            'umur_bulan' => (int) $request->umur_bulan,

            'tinggi_badan' => (float) $request->tinggi_badan,

            'berat_badan' => (float) $request->berat_badan,
        ]);

        // Kirim ke FastAPI
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

        // Simpan hasil kalkulator
        HasilKalkulator::create([
            'id_anak' => $anak->id,

            'hasil_prediksi' => $hasil['prediction'],

            'penjelasan' => $hasil['penjelasan'],

            'rekomendasi' => $hasil['rekomendasi'],
        ]);

        return view('kalkulator', compact('hasil'));
    }
}