<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PemilihanHub extends Model {
    
    protected $table = 'pemilihan_hub';

    protected $fillable = [
        'id_calon','id_cu'
    ];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}