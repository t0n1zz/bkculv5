<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class Kegiatan extends Model {
    
    protected $table = 'kegiatan';
    
    public static $rules = [
        'name' => 'required',
        'tanggal' => 'required',
        'tanggal2' => 'required'
    ];
    
    protected $fillable = [
        'name','periode','tanggal','tanggal2','tempat','max','min','tujuan','pokok','keterangan'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}