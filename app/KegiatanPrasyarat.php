<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanPrasyarat extends Model {

    protected $table = 'kegiatan_prasyarat';

    protected $fillable = [
        'id_prasyarat','id_kegiatan'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function kegiatan(){
        return $this->belongsTo('App\Kegiatan','id_kegiatan','id')->select('id','kode','name');
    }
}