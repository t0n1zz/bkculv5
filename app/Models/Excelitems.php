<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;

class Excel extends Model {
    
    protected $table = 'excelitems';
    
    public $fillable = ['title','description'];
}