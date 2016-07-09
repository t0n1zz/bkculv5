<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class KegiatanEvaluasi extends Model {

    protected $table = 'kegiatan_evaluasi';

    protected $fillable = [
        'id_kegiatan','tipe1','tipe2','nilai',
        'jumlah'
    ];

}