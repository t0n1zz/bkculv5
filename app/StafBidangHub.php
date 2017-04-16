<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafBidangHub extends Model {

    protected $table = 'staf_bidanghub';

    protected $fillable = [
        'id_staf','id_bidang'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function bidang(){
        return $this->belongsTo('App\StafBidang','id_bidang','id');
    }
}