<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pemilihan extends Model {
    
    protected $table = 'pemilihan';
    
    public static $rules = [
        'name'=>'required'
    ];
    
    protected $fillable = [
        'name','mulai','selesai'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}