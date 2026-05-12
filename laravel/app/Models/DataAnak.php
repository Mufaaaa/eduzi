<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAnak extends Model
{
    protected $table = 'data_anak';

    protected $fillable = [
        'id_user',
        'nama_anak',
        'jenis_kelamin',
        'umur_bulan',
        'tinggi_badan',
        'berat_badan',
    ];

    public function hasilKalkulator()
    {
        return $this->hasOne(HasilKalkulator::class, 'id_anak');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}