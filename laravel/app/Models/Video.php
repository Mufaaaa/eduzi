<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'judul',
        'url_video',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
