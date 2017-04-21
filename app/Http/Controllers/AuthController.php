<?php
namespace App\Http\Controllers;

use Auth;
use Input;
use Validator;
use DB;
use Date;
use Redirect;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller{

    use ThrottlesLogins;

    public function authenticated(Request $request,User $user){
        $previous_session = $user->session_id;

        if ($previous_session) {
            \Session::getHandler()->destroy($previous_session);
        }

        Auth::user()->session_id = \Session::getId();
        Auth::user()->save();
        return redirect()->intended($this->redirectPath());
    }
    
    public function getLogin()
    {
        if(Auth::check()){
            return Redirect::route('admins');
        }

        return view('admins.auth.login')->with('errormessage','Maaf, anda harus login terlebih dahulu.');
    }

    public function postLogin()
    {
        $data = Input::all();

        if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))){

            if(Auth::check()) { $id = Auth::user()->getId();}
            $admin = User::find($id);

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

    public function getLogout()
    {
            Auth::logout();
            return Redirect::route('admins.login')->with('sucessmessage','Anda telah berhasil logout.');
    }

}