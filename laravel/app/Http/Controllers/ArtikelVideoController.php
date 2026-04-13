<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelVideoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $artikels = Artikel::when($search, function ($query, $search) {
                $query->where('judul', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('artikelvideo', compact('artikels', 'search'));
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);

        $latest = Artikel::where('id', '!=', $id)
            ->latest()
            ->take(5)
            ->get();

        $sidebarArtikel = Artikel::where('id', '!=', $id)
            ->latest()
            ->take(4)
            ->get();

        return view('detailartikel', compact('artikel', 'latest', 'sidebarArtikel'));
    }
}