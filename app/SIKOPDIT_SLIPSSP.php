<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_SLIPSSP extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'SLIPSSP';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function OPERATOR(){
    	return $this->belongsTo('App\SIKOPDIT_OPERATOR','KDOPR','KDOPR');
    }
}