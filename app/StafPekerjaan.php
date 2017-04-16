<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafPekerjaan extends Model {

    protected $table = 'staf_pekerjaan';

    protected $fillable = [
        'id_staf','tipe','name','bidang','tingkat','tempat','mulai','selesai','sekarang'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
        return $this->belongsTo('App\Staf','id_staf','id');
    }
}