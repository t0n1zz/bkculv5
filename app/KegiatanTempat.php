<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanTempat extends Model {

    protected $table = 'kegiatan_tempat';

    protected $fillable = [
        'name','keterangan','gambar'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}