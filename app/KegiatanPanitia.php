<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanPanitia extends Model {
    use SoftDeletes;

    protected $table = 'kegiatan_panitia';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_kegiatan','id_panitia','tugas','status'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
    	return $this->belongsTo('App\Staf','id_panitia','id');
    }
}