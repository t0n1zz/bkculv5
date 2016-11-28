<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class Kegiatan extends Model {
    
    protected $table = 'kegiatan';
    
    public static $rules = [
        'name' => 'required|min:5',
        'wilayah' => 'required',
        'tempat' => 'required',
        'sasaran' => 'required',
        'tanggal' => 'required',
        'tanggal2' => 'required'
    ];
    
    protected $fillable = [
        'name','penulis','tanggal','tanggal2','wilayah','tempat','sasaran','fasilitator','tujuan','pokok'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function Admin(){
        return $this->belongsTo('App\Models\Admin','penulis','id');
    }
}