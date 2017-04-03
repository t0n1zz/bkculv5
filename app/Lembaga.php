<?php
namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lembaga extends Model {
    use SoftDeletes;

    protected $table = 'lembaga';
    protected $dates = ['deleted_at'];
    
    public static $rules = [
        'name' => 'required|min:5'
    ];
    
    protected $fillable = ['name','alamat','email','telp'];

    public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }
}