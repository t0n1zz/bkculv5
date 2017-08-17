<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SIKOPDIT_PERKSA extends Model {

    protected $connection = 'firebird';
    
    protected $table = 'PERKSA';
    
    public static $rules = [];
    
    protected $fillable = [];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function PERKIRAAN(){
        return $this->belongsTo('App\SIKOPDIT_PERKIRAAN','NOPRK','NOPRK');
    }
}