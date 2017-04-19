<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class StafPekerjaan extends Model {

    protected $table = 'staf_pekerjaan';

    protected $fillable = [
        'id_staf','id_bidang','id_tempat','tipe','name','tingkat','mulai','selesai','sekarang'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function staf(){
        return $this->belongsTo('App\Staf','id_staf','id');
    }

    public function lembaga(){
        return $this->belongsTo('App\Lembaga','id_tempat','id')->select(array('id','name'));
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','id_tempat','no_ba')->select(array('id','no_ba','name'))->withTrashed();
    }

    public function bidanghub(){
        return $this->hasMany('App\StafBidangHub','id_pekerjaan','id_bidang');
    }
}