<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_TRSW extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'TRSW';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function SLIPSSP(){
        return $this->belongsTo('App\SIKOPDIT_SLIPSHR','NOSLIP','NOSLIP');
    }
}