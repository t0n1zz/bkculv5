<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_JURNALMST extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'JURNALMST';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function JURNALDTL(){
        return $this->belongsTo('App\SIKOPDIT_JURNALDTL','NOJUR','NOJUR');
    }
}