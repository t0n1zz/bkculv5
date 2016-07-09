<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class Download extends Model{
    
    protected $table = 'download';
    
    public static $rules = [
        'name' => 'required|between:5,100'
    ];
    
    protected $fillable = ['name','filename','content'];

}