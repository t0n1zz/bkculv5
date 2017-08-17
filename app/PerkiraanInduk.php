<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class PerkiraanInduk extends Model {
    
    protected $table = 'perkiraan_induk';
    
    protected $fillable = [
        'kode_induk','name_induk'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}