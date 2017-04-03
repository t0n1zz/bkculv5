<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class Staf extends Model {
    
    protected $table = 'staf';
    
    public static $rules = [
        'nid'=>'required|unique:staf',
        'name'=>'required',
        'email' =>  'email'
    ];
    
    protected $fillable = [
        'nim','nid','name','cu','tempat_lahir','tanggal_lahir','kelamin',
        'agama','status','alamat','kontak','gambar'
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