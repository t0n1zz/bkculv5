<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PemilihanCalon extends Model {
    
    protected $table = 'pemilihan_calon';
    
    protected $fillable = [
        'id_staf','id_cu','id_pemilihan','jabatan'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
    	return $this->belongsTo('App\Staf','id_staf','id')->select('id','name','gambar');
    }

    public function cu(){
    	return $this->belongsTo('App\Cuprimer','id_cu','no_ba')->select('no_ba','name');
    }

    public function pemilihanhub(){
        return $this->hasMany('App\PemilihanHub','id_calon','id');
    }
}