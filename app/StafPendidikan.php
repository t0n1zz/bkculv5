<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafPendidikan extends Model {

    protected $table = 'staf_pendidikan';

    protected $fillable = [
        'id_staf','tipe','name','tingkat','tempat','mulai','selesai','sekarang'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','keterangan','id');
    }
}