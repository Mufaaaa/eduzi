<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class HomeController extends Controller
{
    public function index()
    {
        $artikels = Artikel::inRandomOrder()
            ->take(3)
            ->get();

        return view('home', compact('artikels'));
    }
}
