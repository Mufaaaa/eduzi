<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeKomunitas extends Model
{
    protected $fillable = [
        'user_id',
        'komunitas_id',
        'komentar_id',
        'guest_identifier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class);
    }

    public function komentar()
    {
        return $this->belongsTo(KomentarKomunitas::class, 'komentar_id');
    }
}
