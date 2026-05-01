<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
    protected $fillable = [
        'user_id',
        'isi',
        'guest_identifier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentar()
    {
        return $this->hasMany(KomentarKomunitas::class);
    }

    public function likes()
    {
        return $this->hasMany(LikeKomunitas::class, 'komunitas_id');
    }
}
