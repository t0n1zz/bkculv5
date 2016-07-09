<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class Artikel extends Model {
    
    protected $table = 'artikel';
    
    public static $rules = [
        'judul' => 'required|min:5',
        'content' => 'required|min:10'
    ];
    
    protected $fillable = ['judul','content','kategori','penulis','status','gambar','pilihan'];

    public function KategoriArtikel(){
        return $this->belongsTo('App\Models\KategoriArtikel','kategori','id');
    }

    public function Admin(){
        return $this->belongsTo('Admin','penulis','id');
    }
}