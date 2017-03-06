<?php

namespace App;

use Kodeine\Acl\Traits\HasRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, ThrottlesLogins, HasRole;

     public static $rules = [
        'username' => 'required|min:5',
        'password' => 'required'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','password','name',
        'logout','login','cu','status','gambar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        public function getNameAttribute($value){
        return !empty($value) ? $value : '-';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getGambar()
    {
        return $this->gambar;
    }

    public function getCU()
    {
        return $this->cu;
    }

    public function getLogout()
    {
        return $this->logout;
    }

    public function getPass()
    {
        return $this->password;
    }

    public function cuprimer(){
        return $this->belongsTo('App\Cuprimer','cu','no_ba')->withTrashed();
    }
}
