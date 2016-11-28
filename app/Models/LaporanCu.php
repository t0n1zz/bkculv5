<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class LaporanCu extends Model {
    
    protected $table = 'perkembangancu';
    
    public static $rules = [];

    protected $fillable = [
        'no_ba','l_biasa','l_lbiasa','p_biasa','p_lbiasa','totalanggota_lalu','aset','aset_lalu',
        'aset_masalah','aset_tidak_menghasilkan','aset_likuid_tidak_menghasilkan',
        'aktivalancar','simpanansaham','simpanansaham_lalu','nonsaham_unggulan','nonsaham_harian',
        'hutangspd','hutang_tidak_berbiaya_30hari','piutangberedar','piutanganggota','piutanglalai_1bulan','piutanglalai_12bulan',
        'dcr','dcu','totalhutang_pihak3','iuran_gedung','donasi','bjs_saham','beban_operasional','investasi_likuid',
        'totalpendapatan','totalbiaya','shu','shu_lalu','lajuinflasi','hargapasar','periode'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '0';
    }

     public function cuprimer(){
        return $this->belongsTo('App\Models\Cuprimer','no_ba','no_ba');
    }


}