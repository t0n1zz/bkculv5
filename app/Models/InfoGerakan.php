<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class InfoGerakan extends Model {
    
    protected $table = 'info_gerakan';
    
    public static $rules = [
        'jumlah_anggota'  => 'integer',
        'jumlah_cu'       => 'integer',
        'jumlah_staff_cu' => 'integer',
        'piutang_beredar' => 'integer',
        'piutang_lalai_1' => 'integer',
        'piutang_lalai_2' => 'integer',
        'piutang_bersih'  => 'integer',
        'asset'           => 'integer',
        'shu'             => 'integer'
    ];
    
    protected $fillable = [
        'tanggal','jumlah_anggota','jumlah_cu','jumlah_staff_cu','piutang_beredar','piutang_lalai_1','piutang_lalai_2',
        'piutang_bersih','asset','shu'
    ];
}