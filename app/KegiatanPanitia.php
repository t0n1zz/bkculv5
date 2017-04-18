<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanPanitia extends Model {
    
    protected $table = 'kegiatan_panitia';

    protected $fillable = [
        'id_kegiatan','id_panitia','tugas','status'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
        return $this->belongsTo('App\Staf','id_panitia','id');
    }

    public function kegiatan(){
        return $this->belongsTo('App\Kegiatan','id_kegiatan','id');
    }

    public function kegiatanbkcu(){
        return $this->kegiatan()->where('tipe',1);
    }

    public function kegiatanlembaga(){
        return $this->kegiatan()->where('tipe',2);
    }

    public function kegiatanrapat(){
        return $this->kegiatan()->where('tipe',3);
    }
}