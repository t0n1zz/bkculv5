<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class LaporanCuDiskusi extends Model {
    
    protected $table = 'laporancudiskusi';
    
    public static $rules = [
        'content' => 'required|min:5'
    ];
    
    protected $fillable = ['id_laporan','id_user','content'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function User(){
        return $this->belongsTo('App\User','id_user','id');
    }
}