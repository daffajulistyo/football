<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tim extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_tim',
        'logo_tim',
        'tahun_berdiri',
        'alamat_markas',
        'kota_markas'
    ];

    // protected $hidden = ['id'];

    protected $table = 'tim';
    // protected $dates = ['deleted_at'];


    // public $timestamps = false;

    public function pemain(){
        return $this->hasMany(InformasiTim::class,'id_tim');
    }

    public function tim()
    {
        return $this->belongsTo(Tim::class, 'id_tim_home','id_tim_away');
    }

    
}
