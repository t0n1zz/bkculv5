<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class Saran extends Model{
    
    protected $table = 'saran';

    public static $rules = [];

    protected $fillable = ['name','content','ip','tanggal'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

}