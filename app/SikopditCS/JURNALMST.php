<?php
namespace App\SikopditCS;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JURNALMST extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'JURNALMST';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function JURNALDTL(){
        return $this->belongsTo('App\SikopditCS\JURNALDTL','NOJUR','NOJUR');
    }
}