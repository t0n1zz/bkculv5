<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_SIMPANHR extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'SIMPANHR';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function TRSHR(){
        return $this->hasMany('App\SIKOPDIT_TRSHR','NOREK','NOREK');
    }
}