<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;


class Pengumuman extends Model {
    
    protected $table = 'pengumuman';
    
    public static $rules = [
        'name' => 'required|between:5,160'
    ];
    
    protected $fillable = ['name','penulis','urutan'];

    public function Admin(){
        return $this->belongsTo('App\Models\Admin','penulis','id');
    }
}