<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class Cuprimer extends Model {
    
    protected $table = 'cuprimer';
    
    public static $rules = [
        'name' => 'required|min:5',
        'no_ba' => 'requreid'
    ];
    
    protected $fillable = ['no_ba','name','badan_hukum','alamat','pos'
        ,'telp','hp','website','email','gambar','logo','app'
        ,'deskripsi','wilayah','bergabung','ultah','tp','staf'];

    public function WilayahCuprimer(){
        return $this->belongsTo('App\Models\WilayahCuprimer','wilayah','id');
    }

    public function staf(){
        return $this->hasMany('App\Models\Staf','cu','id');
    }
}