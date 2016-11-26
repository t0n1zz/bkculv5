<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model {
    
    protected $table = 'kategori_artikel';
    
    public static $rules = [
        'name' => 'required|between:3,50'
    ];
    
    protected $fillable = ['name','jumlah'];

    public function artikel(){
        return $this->hasMany('App\Models\Artikel','kategori','id')
                    ->where('status','=','1')
                    ->orderBy('created_at','desc')
                    ->take(3);
    }

    public function hasartikel(){
        return $this->hasMany('App\Models\Artikel','kategori','id');
    }
}