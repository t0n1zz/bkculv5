<?php
namespace App\SikopditCS;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JURNALDTL extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'JURNALDTL';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function PERKIRAAN(){
        return $this->belongsTo('App\SikopditCS\PERKIRAAN','NOPRK','NOPRK');
    }

    public function JURNALMST(){
        return $this->hasMany('App\SikopditCS\JURNALMST','NOJUR','NOJUR');
    }
}