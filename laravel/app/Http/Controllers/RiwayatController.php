<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilKalkulator::with('dataAnak')
            ->whereHas('dataAnak', function ($query) {
                $query->where('id_user', Auth::id());
            });

        // Filter berdasarkan nama anak
        if ($request->filled('nama_anak')) {
            $query->whereHas('dataAnak', function ($query) use ($request) {
                $query->where('nama_anak', 'like', '%' . $request->nama_anak . '%');
            });
        }

        // Filter berdasarkan tanggal tes
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $riwayat = $query->latest()->get();

        return view('riwayat', compact('riwayat'));
    }

    public function exportPdf(Request $request)
    {
        $query = HasilKalkulator::with('dataAnak')
            ->whereHas('dataAnak', function ($query) {
                $query->where('id_user', Auth::id());
            });

        // Filter berdasarkan nama anak
        if ($request->filled('nama_anak')) {
            $query->whereHas('dataAnak', function ($query) use ($request) {
                $query->where('nama_anak', 'like', '%' . $request->nama_anak . '%');
            });
        }

        // Filter berdasarkan tanggal tes
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $riwayat = $query->latest()->get();

        $pdf = Pdf::loadView('pdf.riwayat', [
            'riwayat' => $riwayat,
            'tanggal' => $request->tanggal,
            'nama_anak' => $request->nama_anak
        ]);

        return $pdf->download(
            'Riwayat_Gizi_' .
            ($request->nama_anak
                ? str_replace(' ', '_', $request->nama_anak) . '_'
                : '') .
            ($request->tanggal ?? now()->format('Y-m-d')) .
            '.pdf'
        );
    }
}

