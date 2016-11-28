<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class StafRiwayat extends Model {

    protected $table = 'staf_riwayat';

    protected $fillable = [
        'id_staf','tipe','name','keterangan','keterangan2','mulai','selesai','sekarang'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function cuprimer(){
        return $this->belongsTo('App\Models\Cuprimer','keterangan','id');
    }
}