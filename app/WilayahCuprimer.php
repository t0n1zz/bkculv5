<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class WilayahCuprimer extends Model {
    
    protected $table = 'wilayah_cuprimer';
    
    public static $rules = [
        'name' => 'required|min:3'
    ];
    
    protected $fillable = ['name','jumlah'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function hascuprimer(){
        return $this->hasMany('App\Cuprimer','wilayah','id');
    }

    public function Cuprimer(){
        return $this->hasMany('App\Cuprimer','wilayah','id');
    }
}