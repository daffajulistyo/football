<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InformasiTim extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_tim',
        'nama_pemain',
        'tinggi_badan',
        'berat_badan',
        'posisi_pemain',
        'nomor_punggung'
    ];

    protected $hidden = array('id_tim');


    protected $table = 'info_tim';

    public $timestamps = false;

    public function tim()
    {
        return $this->belongsTo(Tim::class, 'id_tim');
    }
}
