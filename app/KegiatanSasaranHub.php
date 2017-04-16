<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanSasaranHub extends Model {

    protected $table = 'kegiatan_sasaranhub';

    protected $fillable = [
        'id_kegiatan','id_sasaran'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
    
    public function sasaran(){
        return $this->belongsTo('App\KegiatanSasaran','id_sasaran','id');
    }
}