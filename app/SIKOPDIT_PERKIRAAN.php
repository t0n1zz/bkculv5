<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_PERKIRAAN extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'PERKIRAAN';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function PERKSA(){
        return $this->hasMany('App\SIKOPDIT_PERKSA','NOPRK','NOPRK');
    }

    public function JURNALDTL(){
        return $this->hasMany('App\SIKOPDIT_JURNALDTL','NOPRK','NOPRK');
    }
}