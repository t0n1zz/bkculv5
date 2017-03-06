<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class Staf extends Model {
    
    protected $table = 'staf';
    
    public static $rules = [
        'name'=>'required',
        'jabatan'=>'required',
        'tingkat'=>'required',
        'cu'=>'required',
        'email' =>  'email'
    ];
    
    protected $fillable = [
        'name','jabatan','tingkat','cu','periode1','periode2','tempat_lahir','tanggal_lahir','kelamin',
        'agama','pendidikan','status','alamat','kota','gambar',
        'telp','hp','email'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','cu','id');
    }

    public function riwayat(){
        return $this->hasMany('App\StafRiwayat','id_staf','id');
    }
}