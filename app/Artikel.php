<?php
namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use illuminate\Database\Eloquent\Model;

class Artikel extends Model {
    
    use HasSlug;

    protected $table = 'artikel';
    
    public static $rules = [
        'judul' => 'required|min:5',
        'content' => 'required|min:10'
    ];
    
    protected $fillable = ['judul','content','kategori','penulis','status','gambar','pilihan'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    protected $casts = [
        'status' => 'boolean',
        'pilihan' => 'boolean',
    ];

    public function KategoriArtikel(){
        return $this->belongsTo('App\KategoriArtikel','kategori','id');
    }

    public function Admin(){
        return $this->belongsTo('Admin','penulis','id');
    }

      /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('url');
    }
}