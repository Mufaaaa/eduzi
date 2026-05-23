<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilKalkulator extends Model
{
    use HasFactory;

    protected $table = 'hasil_kalkulator';

    protected $fillable = [
        'id_anak',
        'hasil_prediksi',
        'penjelasan',
        'rekomendasi',
        'bmi',
    ];

    public function dataAnak()
    {
        return $this->belongsTo(DataAnak::class, 'id_anak');
    }

    
}