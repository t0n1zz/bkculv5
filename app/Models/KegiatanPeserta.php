<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class KegiatanPeserta extends Model {

    protected $table = 'kegiatan_panitia';

    protected $fillable = [
        'id_kegiatan','id_peserta','status'
    ];

}