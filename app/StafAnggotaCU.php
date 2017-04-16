<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafAnggotaCU extends Model {

    protected $table = 'staf_anggotacu';

    protected $fillable = [
        'id_staf','name','no_ba'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
        return $this->belongsTo('App\Staf','id_staf','id');
    }
}