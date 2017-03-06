<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class Pelayanan extends Model {
    
    protected $table = 'pelayanan';
    
    public static $rules = [
        'name' => 'required|min:5',
        'content' => 'required|min:10'
    ];
    
    protected $fillable = ['name','gambar','content'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}