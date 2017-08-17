<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class SimpananBKCUTr extends Model {
    
    protected $table = 'simpanan_bkcu_tr';
    
    protected $fillable = [
        'no_rek','no_slip','jenis','snd','jumlah','penyetor','keterangan','operator','tanggal'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}