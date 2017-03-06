<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuprimer extends Model {
    use SoftDeletes;

    protected $table = 'cuprimer';
    protected $dates = ['deleted_at'];
    
    public static $rules = [
        'name' => 'required|min:5',
        'no_ba' => 'required'
    ];
    
    protected $fillable = ['no_ba','name','badan_hukum','alamat','pos'
        ,'telp','hp','website','email','gambar','logo','app'
        ,'deskripsi','wilayah','bergabung','ultah','tp','staf'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function WilayahCuprimer(){
        return $this->belongsTo('App\WilayahCuprimer','wilayah','id');
    }

    public function staf(){
        return $this->hasMany('App\Staf','cu','id');
    }
}