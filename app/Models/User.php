<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Kodeine\Acl\Traits\HasRole;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {


	use Authenticatable, CanResetPassword, HasRole;

    public static $rules = [
        'username' => 'required|min:5',
        'password' => 'required'
    ];

    protected $fillable = ['username','password','name',
        'logout','login','cu','status','gambar'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
        'password', 'remember_token'
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
        return $this->belongsTo('App\Models\Cuprimer','cu','no_ba');
    }
}
