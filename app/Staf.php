<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Staf extends Model {
    
    protected $table = 'staf';
    
    public static $rules = [
        'nid'=>'required|unique:staf',
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

    public function pekerjaan(){
        return $this->hasMany('App\StafPekerjaan','id','id_staf');
    }
}