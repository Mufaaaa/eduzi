<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilKalkulator extends Model
{
    protected $table = 'hasil_kalkulator';

    protected $fillable = [
        'id_anak',
        'hasil_prediksi',
        'penjelasan',
        'rekomendasi',
    ];

    public function dataAnak()
    {
        return $this->belongsTo(DataAnak::class, 'id_anak');
    }
}