<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract {

    // This is trait for using entrust
    use EntrustUserTrait;

	use Authenticatable, CanResetPassword;

    public static $rules = [
        'username' => 'required|min:5',
        'password' => 'required'
    ];

    protected $fillable = ['username','password',
        'name','logout','login',
        'cu','status'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admin';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

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

    public function getLogout()
    {
        return $this->logout;
    }

    public function cuprimer(){
        return $this->belongsTo('App\Models\Cuprimer','cu','id');
    }
}
