<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class TpCU extends Model {

    protected $table = 'tpcu';

    public static $rules = [
        'name' => 'required|min:5',
        'cu' => 'required'
    ];

    protected $fillable = [
        'cu','no_tp','name','ultah','telp','hp','pos','alamat','gambar'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','cu','no_ba')->withTrashed();
    }

}