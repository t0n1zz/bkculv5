<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanBiaya extends Model {

    protected $table = 'kegiatan_biaya';

    protected $fillable = [
        'id_kegiatan','uraian','tipe','tanggal',
        'jumlah','nominal','keterangan'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

}