<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanPeserta extends Model {
    use SoftDeletes;

    protected $table = 'kegiatan_peserta';
    protected $dates = ['deleted_at'];

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
}