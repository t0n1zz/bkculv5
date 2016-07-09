<?php
namespace App\Http\Controllers;

use Auth;
use Input;
use Validator;
use DB;
use Date;
use Redirect;

use App\Models\Admin;

class AdminAuthController extends controller{

    public function getLogin()
    {
        if(Auth::check()){
            if(!Auth::user()->hasRole('cu'))
                return Redirect::route('admins');
        }

        return view('admins.auth.login')->with('errormessage','Maaf, anda harus login terlebih dahulu.');
    }

    public function getLogin_public()
    {
        try{
            if(Auth::check()){
                if(Auth::user()->hasRole('cu'))
                    return Redirect::route('admins');
            }

            return view('cu.login')->with('errormessage','Maaf, anda harus login terlebih dahulu.');
        }catch (Exception $e){
            return Redirect::route('cu.login')->with('errormessage','Terjadi kesalahan.');
        }
    }

    public function postLogin()
    {
        $data = Input::all();

        $validator = Validator::make($data, Admin::$rules);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))){
            if(Auth::user()->hasRole('cu')){
                Auth::logout();
                return Redirect::route('admins.login')->with('errormessage','Username atau password anda salah.');
            }

            if(Auth::check()) { $id = Auth::user()->getId();}
            $admin = Admin::find($id);

            if($admin->status == 0){
                Auth::logout();
                return Redirect::route('admins.login')->with('errormessage','Maaf akun anda tidak aktif.');
            }
            $tanggal = $admin->login;
            $admin->logout = $tanggal;
            $admin->login = Date::now();
            if($admin->update())
                return Redirect::intended('admins');

            return Redirect::route('admins.login')->with('errormessage','Terjadi kesalahan.');
        }

        return Redirect::route('admins.login')->with('errormessage','Username atau password anda salah.');
    }

    public function postLogin_public()
    {
        try{
            $data = Input::all();

            $validator = Validator::make($data, Admin::$rules);
            if($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))){
                if(!Auth::user()->hasRole('cu')){
                    Auth::logout();
                    return Redirect::route('cu.login')->with('errormessage','Username atau password anda salah.');
                }

                if(Auth::check()) { $id = Auth::user()->getId();}
                $admin = Admin::find($id);

                if($admin->status == 0){
                    Auth::logout();
                    return Redirect::route('cu.login')->with('errormessage','Maaf akun anda tidak aktif.');
                }

                $tanggal = $admin->login;
                $admin->logout = $tanggal;
                $admin->login = Date::now();
                if($admin->update())
                    return Redirect::intended('cu');
            }
            return Redirect::route('cu.login')->with('errormessage','Username atau password anda salah.');

        }catch (Exception $e){
            return Redirect::route('cu.login')->with('errormessage','Terjadi kesalahan.');
        }
    }

    public function getLogout()
    {
            Auth::logout();
            return Redirect::route('admins.login')->with('sucessmessage','Anda telah berhasil logout.');
    }

    public function getLogout_public()
    {
        Auth::logout();
        return Redirect::route('cu.login')->with('sucessmessage','Anda telah berhasil logout.');
    }

}