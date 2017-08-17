<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class SimpananBKCU extends Model {
    
    protected $table = 'simpanan_bkcu';
    
    protected $fillable = [
        'no_rek','no_ba','tipe','awal','akhir','buka','tutup'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function SimpananBKCUTr(){
        return $this->hasMany('App\SimpananBKCUTr','no_rek','no_rek');
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','no_ba','no_ba')->withTrashed()->select('no_ba','name','wilayah');
    }
}