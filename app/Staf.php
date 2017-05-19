<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Staf extends Model {
    
    protected $table = 'staf';
    
    public static $rules = [
        'nid'=>'required',
        'name'=>'required',
        'email' =>  'email'
    ];
    
    protected $fillable = [
        'nim','nid','name','tempat_lahir','tanggal_lahir','kelamin',
        'agama','status','alamat','kontak','gambar'
    ];

    /**
     * Accessor for Age.
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_lahir'])->age;
    }

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function pendidikan(){
        return $this->hasMany('App\StafPendidikan','id_staf','id');
    }

    public function pendidikan_tertinggi(){
        return $this->pendidikan()->orderBy('tingkat','desc');
    }

    public function pekerjaan(){
        return $this->hasMany('App\StafPekerjaan','id_staf','id');
    }

    public function pekerjaan_aktif(){
        return $this->pekerjaan()->where('sekarang','1')->orWhere('selesai','>',date('Y-m-d'));
    }

    public function keluarga(){
        return $this->hasMany('App\StafKeluarga','id_staf','id');
    }

    public function anggotacu(){
        return $this->hasMany('App\StafAnggotaCU','id_staf','id');
    }

    public function organisasi(){
        return $this->hasMany('App\StafOrganisasi','id_staf','id');
    }

    public function kegiatanpeserta(){
        return $this->hasMany('App\KegiatanPeserta','id_peserta','id');
    }

    public function kegiatanpanitia(){
        return $this->hasMany('App\KegiatanPanitia','id_panitia','id');
    }
}