<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_TRSHR extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'TRSHR';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function SLIPSHR(){
        return $this->belongsTo('App\SIKOPDIT_SLIPSHR','NOSLIP','NOSLIP');
    }
}