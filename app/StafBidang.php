<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafBidang extends Model {

    protected $table = 'staf_bidang';

    protected $fillable = [
        'name'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

}