<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanTempat extends Model {

    protected $table = 'kegiatan_tempat';

    public static $rules = [
        'name' => 'required',
    ];

    protected $fillable = [
        'name','kota','keterangan','gambar'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}