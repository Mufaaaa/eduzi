<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemantauanController extends Controller
{
    /**
     * Dashboard Pemantauan Anak.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Ambil data anak milik pengguna
        |--------------------------------------------------------------------------
        */

        $semuaAnak = DataAnak::where('id_user', $userId)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Dropdown: satu nama hanya muncul sekali
        |--------------------------------------------------------------------------
        |
        | Karena setiap pemeriksaan dapat membuat record data_anak baru,
        | gunakan nama sebagai pengelompokan sementara.
        | Record terbaru untuk setiap nama menjadi pilihan dropdown.
        |
        */

        $anakList = $semuaAnak
            ->unique(function ($item) {
                return mb_strtolower(trim($item->nama_anak));
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Tentukan anak yang dipilih
        |--------------------------------------------------------------------------
        |
        | Parameter anak tetap menggunakan ID data_anak agar kompatibel
        | dengan link grafik yang sudah ada.
        |
        */

        $anakTerpilih = null;

        if ($request->filled('anak')) {
            $anakTerpilih = $semuaAnak->first(function ($item) use ($request) {
                return (string) $item->id === (string) $request->anak;
            });
        } else {
            $anakTerpilih = $anakList->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Tidak ada data anak
        |--------------------------------------------------------------------------
        */

        if (!$anakTerpilih) {
            return view('dashboardpemantauan', [
                'anak' => null,
                'anakList' => $anakList,
                'terakhir' => null,
                'riwayat' => collect(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Gabungkan semua record dengan nama yang sama
        |--------------------------------------------------------------------------
        |
        | Penggabungan dibatasi berdasarkan ID pengguna agar pemeriksaan
        | milik pengguna lain tidak ikut masuk.
        |
        */

        $namaAnak = trim($anakTerpilih->nama_anak);

        $idAnak = $semuaAnak
            ->filter(function ($item) use ($namaAnak) {
                return mb_strtolower(trim($item->nama_anak))
                    === mb_strtolower($namaAnak);
            })
            ->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh pemeriksaan
        |--------------------------------------------------------------------------
        */

        $riwayat = HasilKalkulator::with('dataAnak')
            ->whereIn('id_anak', $idAnak)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Pemeriksaan terbaru
        |--------------------------------------------------------------------------
        */

        $terakhir = $riwayat->first();

        /*
        |--------------------------------------------------------------------------
        | Data identitas dan antropometri terbaru
        |--------------------------------------------------------------------------
        |
        | Record terbaru dipakai untuk menampilkan umur, berat, dan tinggi.
        |
        */

        $anak = $semuaAnak
            ->first(function ($item) use ($namaAnak) {
                return mb_strtolower(trim($item->nama_anak))
                    === mb_strtolower($namaAnak);
            });

        /*
        |--------------------------------------------------------------------------
        | Kirim data ke Blade
        |--------------------------------------------------------------------------
        */

        return view('dashboardpemantauan', [
            'anak' => $anak,
            'anakList' => $anakList,
            'terakhir' => $terakhir,
            'riwayat' => $riwayat,
        ]);
    }

    /**
     * Grafik Perkembangan Gizi.
     */
    public function grafik(Request $request)
    {
        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh data anak milik pengguna
        |--------------------------------------------------------------------------
        */

        $semuaAnak = DataAnak::where('id_user', $userId)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        $anakList = $semuaAnak
            ->unique(function ($item) {
                return mb_strtolower(trim($item->nama_anak));
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Tentukan anak yang dipilih
        |--------------------------------------------------------------------------
        */

        if ($request->filled('anak')) {
            $anak = $semuaAnak->first(function ($item) use ($request) {
                return (string) $item->id === (string) $request->anak;
            });
        } else {
            $anak = $anakList->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Jika belum ada data anak
        |--------------------------------------------------------------------------
        */

        if (!$anak) {
            return redirect()
                ->route('pemantauan')
                ->with('error', 'Belum ada data anak.');
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh record anak dengan nama yang sama
        |--------------------------------------------------------------------------
        */

        $namaAnak = trim($anak->nama_anak);

        $idAnak = $semuaAnak
            ->filter(function ($item) use ($namaAnak) {
                return mb_strtolower(trim($item->nama_anak))
                    === mb_strtolower($namaAnak);
            })
            ->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh hasil pemeriksaan berdasarkan urutan waktu
        |--------------------------------------------------------------------------
        */

        $riwayat = HasilKalkulator::with('dataAnak')
            ->whereIn('id_anak', $idAnak)
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Bentuk data grafik
        |--------------------------------------------------------------------------
        */

        $grafikData = $riwayat
            ->map(function ($hasil) {
                $dataAnak = $hasil->dataAnak;

                if (!$dataAnak) {
                    return null;
                }

                return [
                    'tanggal' => $hasil->created_at->format('d M Y'),
                    'berat' => (float) $dataAnak->berat_badan,
                    'tinggi' => (float) $dataAnak->tinggi_badan,
                    'umur' => (int) $dataAnak->umur_bulan,
                    'status' => $hasil->hasil_prediksi,
                ];
            })
            ->filter()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Kirim data ke Blade grafik
        |--------------------------------------------------------------------------
        |
        | Nama view dan format data utama dipertahankan agar sesuai
        | dengan implementasi grafik yang sudah ada.
        |
        */

        return view('grafik-perkembangan-gizi', [
            'anak' => $anak,
            'anakList' => $anakList,
            'riwayat' => $riwayat,
            'grafikData' => $grafikData,
        ]);
    }
}
