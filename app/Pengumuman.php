<?php
namespace App;

use illuminate\Database\Eloquent\Model;


class Pengumuman extends Model {
    
    protected $table = 'pengumuman';
    
    public static $rules = [
        'name' => 'required|between:5,160'
    ];
    
    protected $fillable = ['name','penulis','urutan'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function Admin(){
        return $this->belongsTo('App\Admin','penulis','id');
    }
}