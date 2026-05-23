<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komunitas extends Model
{
    use HasFactory;

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