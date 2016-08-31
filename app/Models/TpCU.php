<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class TpCU extends Model {

    protected $table = 'tpcu';

    public static $rules = [
        'name' => 'required|min:5'
    ];

    protected $fillable = [
        'cu','name','ultah','l_biasa','l_lbiasa','p_biasa','p_lbiasa','l_staf','p_staf','alamat'
    ];

    public function cuprimer(){
        return $this->belongsTo('App\Models\Cuprimer','cu','id');
    }

}