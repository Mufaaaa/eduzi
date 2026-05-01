<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarKomunitas extends Model
{
    protected $fillable = [
        'komunitas_id',
        'user_id',
        'reply_to_user_id',
        'isi',
        'guest_identifier',
    ];

    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replyTo()
    {
        return $this->belongsTo(User::class, 'reply_to_user_id');
    }

    public function likes()
    {
        return $this->hasMany(LikeKomunitas::class, 'komentar_id');
    }
}
