<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class PerkembanganCU extends Model {
    
    protected $table = 'perkembangancu';
    
     public static $rules = [
        
    ];

    protected $fillable = [
        'cu','l_biasa','l_lbiasa','p_biasa','p_lbiasa','kekayaan',
        'aktivalancar','simpanansaham','nonsaham_unggulan','nonsaham_harian',
        'hutangspd','piutangberedar','piutanglalai_1bulan','piutanglalai_12bulan',
        'dcr','dcu','totalpendapatan','totalbiaya','shu',
        'dataper'
    ];

     public function cuprimer(){
        return $this->belongsTo('App\Models\Cuprimer','cu','no_ba');
    }


}