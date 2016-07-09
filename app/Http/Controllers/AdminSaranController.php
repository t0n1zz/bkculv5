<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\Saran;

class AdminSaranController extends Controller {

    protected $indexpath = 'admins.saran.index';

    public function index()
    {
        try{
            $datas = Saran::orderBy('created_at','desc')->get();;
            return view($this->indexpath, compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');

            Saran::destroy($id);
            return Redirect::route($this->indexpath)->with('sucessmessage', 'Saran atau kritik telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}