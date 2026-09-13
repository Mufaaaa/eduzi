<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemantauanController extends Controller
{
    /**
     * Dashboard Pemantauan Anak
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh data anak milik user
        |--------------------------------------------------------------------------
        */

        $anakList = DataAnak::where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Pilih anak
        |--------------------------------------------------------------------------
        */

        if ($request->filled('anak')) {

            $anak = DataAnak::where('id', $request->anak)
                ->where('id_user', $userId)
                ->first();

        } else {

            $anak = $anakList->first();

        }

        /*
        |--------------------------------------------------------------------------
        | Tidak ada anak
        |--------------------------------------------------------------------------
        */

        if (!$anak) {

            return view('dashboardpemantauan', [
                'anak' => null,
                'anakList' => $anakList,
                'terakhir' => null,
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Ambil hasil kalkulator anak
        |--------------------------------------------------------------------------
        */

        $terakhir = $anak->hasilKalkulator;

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view('dashboardpemantauan', [
            'anak' => $anak,
            'anakList' => $anakList,
            'terakhir' => $terakhir,
        ]);
    }


    /**
     * Grafik Perkembangan Gizi
     */
    public function grafik(Request $request)
    {
        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Anak yang dipilih
        |--------------------------------------------------------------------------
        */

        if ($request->filled('anak')) {

            $anak = DataAnak::where('id', $request->anak)
                ->where('id_user', $userId)
                ->first();

        } else {

            $anak = DataAnak::where('id_user', $userId)
                ->latest()
                ->first();

        }

        /*
        |--------------------------------------------------------------------------
        | Jika tidak ada anak
        |--------------------------------------------------------------------------
        */

        if (!$anak) {

            return redirect()
                ->route('pemantauan')
                ->with('error', 'Belum ada data anak.');

        }

        /*
        |--------------------------------------------------------------------------
        | Ambil riwayat
        |--------------------------------------------------------------------------
        |
        | Karena setiap pemeriksaan saat ini membuat record baru
        | pada data_anak, kita mengambil data anak berdasarkan
        | nama anak yang sama.
        |
        */

        $riwayatAnak = DataAnak::where('id_user', $userId)
            ->where('nama_anak', $anak->nama_anak)
            ->with('hasilKalkulator')
            ->orderBy('created_at', 'asc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Bentuk data untuk grafik
        |--------------------------------------------------------------------------
        */

        $grafikData = $riwayatAnak
            ->filter(function ($item) {

                return $item->hasilKalkulator !== null;

            })
            ->map(function ($item) {

                return [

                    'tanggal' => $item->created_at
                        ->format('d M Y'),

                    'berat' => (float) $item->berat_badan,

                    'tinggi' => (float) $item->tinggi_badan,

                    'umur' => (int) $item->umur_bulan,

                    'status' => $item->hasilKalkulator
                        ->hasil_prediksi,

                ];

            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Riwayat hasil kalkulator
        |--------------------------------------------------------------------------
        */

        $riwayat = $riwayatAnak
            ->filter(function ($item) {

                return $item->hasilKalkulator !== null;

            })
            ->map(function ($item) {

                return $item->hasilKalkulator;

            });


        /*
        |--------------------------------------------------------------------------
        | Kirim ke Blade
        |--------------------------------------------------------------------------
        */

        return view('grafik-perkembangan-gizi', [

            'anak' => $anak,

            'riwayat' => $riwayat,

            'grafikData' => $grafikData,

        ]);
    }
}