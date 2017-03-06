<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanPanitia extends Model {

    protected $table = 'kegiatan_panitia';

    protected $fillable = [
        'id_kegiatan','id_panitia','tugas','status',
        'insentif'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}