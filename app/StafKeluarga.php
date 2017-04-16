<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafKeluarga extends Model {

    protected $table = 'staf_keluarga';

    protected $fillable = [
        'id_staf','name','tipe'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
        return $this->belongsTo('App\Staf','id_staf','id');
    }
}