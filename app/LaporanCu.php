<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanCu extends Model {
    use \Venturecraft\Revisionable\RevisionableTrait;
    use SoftDeletes;
    protected $table = 'laporancu';
    protected $dates = ['deleted_at'];
    public static $rules = [];

    public static function boot()
    {
        parent::boot();
    }

    protected $dontKeepRevisionOf = array(
        'deleted_at'
    );

    protected $fillable = [
        'no_ba','l_biasa','l_lbiasa','p_biasa','p_lbiasa','totalanggota_lalu','aset','aset_lalu',
        'aset_masalah','aset_tidak_menghasilkan','aset_likuid_tidak_menghasilkan',
        'aktivalancar','simpanansaham','simpanansaham_lalu','simpanansaham_des','nonsaham_unggulan','nonsaham_harian',
        'hutangspd','hutang_tidak_berbiaya_30hari','piutangberedar','piutanganggota','piutanglalai_1bulan','piutanglalai_12bulan',
        'dcr','dcu','totalhutang_pihak3','iuran_gedung','donasi','bjs_saham','beban_penyisihandcr','investasi_likuid',
        'totalpendapatan','totalbiaya','shu','shu_lalu','lajuinflasi','hargapasar','periode'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '0.01';
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','no_ba','no_ba');
    }

    public function cuprimer_all(){
        return $this->belongsTo('App\Cuprimer','no_ba','no_ba')->withTrashed();
    }
}