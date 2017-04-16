<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class KegiatanSasaran extends Model {

    protected $table = 'kegiatan_sasaran';

    protected $fillable = [
        'name'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

}