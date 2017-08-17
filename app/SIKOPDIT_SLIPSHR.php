<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_SLIPSHR extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'SLIPSHR';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function TRSHR(){
    	return $this->hasMany('App\SIKOPDIT_TRSHR','NOSLIP','NOSLIP');
    }

    public function OPERATOR(){
    	return $this->belongsTo('App\SIKOPDIT_OPERATOR','KDOPR','KDOPR');
    }
}