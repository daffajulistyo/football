<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Hasil extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_jadwal',
        'id_info_tim',
        'total_skor',
        'waktu_gol'
    ];

    protected $hidden = [
        'id_jadwal',
        'id_info_tim'
    ];


    protected $table = 'hasil';

    public $timestamps = false;


    public function jadwal() {
        return $this->hasOne(Jadwal::class,'id', 'id_jadwal');
    }
    public function pencetak_gol() {
        return $this->hasOne(InformasiTim::class, 'id','id_info_tim',);
    }
}
