<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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