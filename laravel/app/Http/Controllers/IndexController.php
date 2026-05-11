<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class IndexController extends Controller
{
    public function index()
    {
        $artikels = Artikel::inRandomOrder()
            ->take(3)
            ->get();

        return view('index', compact('artikels'));
    }
}