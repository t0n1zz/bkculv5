<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class PerkiraanAI extends Model {
    
    protected $table = 'perkiraan_ai';
    
    protected $fillable = [
        'kode','name','kode_induk','kelompok','cu',
        'tp'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function induk(){
        return $this->belongsTo('App\PerkiraanInduk','kode_induk','id');
    }
}