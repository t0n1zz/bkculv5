<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafOrganisasi extends Model {

    protected $table = 'staf_organisasi';

    protected $fillable = [
        'id_staf','tipe','name','jabatan','tempat','mulai','selesai','sekarang'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','keterangan','id');
    }
}