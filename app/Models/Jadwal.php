<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Jadwal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tanggal_pertandingan',
        'waktu_pertandingan',
        'id_tim_home',
        'id_tim_away'
    ];

    protected $hidden = [
        'id_tim_home',
        'id_tim_away'
    ];


    protected $table = 'jadwal';

    public $timestamps = false;

    public function tim_home() {
        return $this->hasOne(Tim::class,'id', 'id_tim_home');
    }
    public function tim_away() {
        return $this->hasOne(Tim::class, 'id','id_tim_away');
    }
}
