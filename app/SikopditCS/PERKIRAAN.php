<?php
namespace App\SikopditCS;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PERKIRAAN extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'PERKIRAAN';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function PERKSA(){
        return $this->hasMany('App\SikopditCS\PERKSA','NOPRK','NOPRK');
    }

    public function JURNALDTL(){
        return $this->hasMany('App\SikopditCS\JURNALDTL','NOPRK','NOPRK');
    }
}