<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';

    protected $fillable = [
        'id_user',
        'kategori',
        'judul',
        'isi',
        'gambar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
