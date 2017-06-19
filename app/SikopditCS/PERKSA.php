<?php
namespace App\SikopditCS;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PERKSA extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'PERKSA';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function PERKIRAAN(){
        return $this->belongsTo('App\SikopditCS\PERKIRAAN','NOPRK','NOPRK');
    }
}