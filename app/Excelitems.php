<?php
namespace App;

use illuminate\Database\Eloquent\Model;

class Excel extends Model {
    
    protected $table = 'excelitems';
    
    public $fillable = ['title','description'];
}