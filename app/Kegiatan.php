<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kegiatan extends Model {
    use SoftDeletes;
    
    protected $table = 'kegiatan';
    protected $dates = ['deleted_at'];
    
    public static $rules = [
        'name' => 'required',
        'tanggal' => 'required',
        'tanggal2' => 'required'
    ];
    
    protected $fillable = [
        'kode','name','periode','tanggal','tanggal2','tipe','id_tempat','kota','max','min','tujuan','ruang','keterangan','deskripsi','peserta'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function tempat(){
        return $this->belongsTo('App\KegiatanTempat','id_tempat','id');
    }

    public function sasaranhub(){
        return $this->hasmany('App\KegiatanSasaranHub','id_kegiatan','id');
    }

    public function prasyarat(){
        return $this->hasMany('App\KegiatanPrasyarat','id_prasyarat','id');
    }

    public function total_peserta(){
        return $this->hasmany('App\KegiatanPeserta','id_kegiatan','id');
    }
}