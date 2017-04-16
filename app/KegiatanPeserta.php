<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanPeserta extends Model {

    protected $table = 'kegiatan_peserta';

    protected $fillable = [
        'id_kegiatan','id_peserta','status'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
    	return $this->belongsTo('App\Staf','id_peserta','id');
    }
}