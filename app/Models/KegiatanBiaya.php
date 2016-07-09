<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class KegiatanBiaya extends Model {

    protected $table = 'kegiatan_biaya';

    protected $fillable = [
        'id_kegiatan','uraian','tipe','tanggal',
        'jumlah','nominal','keterangan'
    ];

}