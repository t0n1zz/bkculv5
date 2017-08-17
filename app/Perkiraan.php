<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class Perkiraan extends Model {
    
    protected $table = 'perkiraan';
    
    protected $fillable = [
        'kode','name','kode_induk','kelompok','cu',
        'tp','periode','awal','akhir'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function induk(){
        return $this->belongsTo('App\PerkiraanInduk','kode_induk','id');
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','cu','no_ba')->select('no_ba','name');
    }
}