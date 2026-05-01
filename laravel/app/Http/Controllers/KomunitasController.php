<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\KomentarKomunitas;
use App\Models\LikeKomunitas;
use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    // tampil halaman + data
    public function index()
    {
        $data = Komunitas::with([
        'user',
        'komentar.user',
        'komentar.replyTo'
            ])->latest()->get();
        return view('komunitas', compact('data'));
    }

    // simpan postingan
    public function store(Request $request)
    {
        $request->validate([
            'postingan' => 'required|string|max:1000',
        ]);

        $guestId = request()->ip();

        // limit guest 3x
        if (!auth()->check()) {
            $count = Komunitas::where('guest_identifier', $guestId)->count();

            if ($count >= 3) {
                return back()->with('error', 'Guest hanya bisa posting 3 kali, silakan login.');
            }
        }

        Komunitas::create([
            'user_id' => auth()->id(),
            'isi' => $request->postingan,
            'guest_identifier' => auth()->check() ? null : $guestId,
        ]);

        return back()->with('success', 'Postingan berhasil ditambahkan!');
    }

    public function komentar(Request $request)
    {
        $request->validate([
            'komunitas_id' => 'required|exists:komunitas,id',
            'isi' => 'required|string|max:500',
        ]);

        KomentarKomunitas::create([
            'komunitas_id' => $request->komunitas_id,
            'user_id' => auth()->id(),
            'reply_to_user_id' => $request->reply_to_user_id, // bisa null
            'isi' => $request->isi,
            'guest_identifier' => auth()->check() ? null : request()->ip(),
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function like(Request $request)
    {
        $guestId = request()->ip();

        $exists = LikeKomunitas::where(function($q) use ($request) {
            $q->where('komunitas_id', $request->komunitas_id)
            ->orWhere('komentar_id', $request->komentar_id);
        })
        ->where(function($q) use ($guestId) {
            $q->where('user_id', auth()->id())
            ->orWhere('guest_identifier', $guestId);
        })
        ->first();

        if ($exists) {
            // unlike
            $exists->delete();
        } else {
            // like
            LikeKomunitas::create([
                'user_id' => auth()->id(),
                'komunitas_id' => $request->komunitas_id,
                'komentar_id' => $request->komentar_id,
                'guest_identifier' => auth()->check() ? null : $guestId,
            ]);
        }

        return back();
    }
}
