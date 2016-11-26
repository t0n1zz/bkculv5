<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class StafRiwayat extends Model {

    protected $table = 'staf_riwayat';

    protected $fillable = [
        'id_staf','tipe','name','keterangan','keterangan2','mulai','selesai','sekarang'
    ];

     public function cuprimer(){
        return $this->belongsTo('App\Models\Cuprimer','keterangan','id');
    }
}