<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = HasilKalkulator::with('dataAnak')
            ->whereHas('dataAnak', function ($query) {
                $query->where('id_user', Auth::id());
            })
            ->latest()
            ->get();

        return view('riwayat', compact('riwayat'));
    }
}