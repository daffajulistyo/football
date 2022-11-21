<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Data extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_jadwal',
        'id_info_tim',
        'skor_akhir',
        'status_akhir',
        'total_win_home',
        'total_win_away'
    ];

    protected $hidden = [
        'id_jadwal',
        'id_info_tim'
    ];


    protected $table = 'data_report';

    public $timestamps = false;


    public function jadwal() {
        return $this->hasOne(Jadwal::class,'id', 'id_jadwal');
    }
    public function pencetak_gol_terbanyak() {
        return $this->hasOne(InformasiTim::class, 'id','id_info_tim',);
    }
}
