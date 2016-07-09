<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\WilayahCuprimer;

class AdminWilayahCuprimerController extends Controller{

    protected $kelaspath = 'wilayahcuprimer';

    public function index()
    {
        try{
            $datas = WilayahCuprimer::orderBy('name','asc')->get();;
            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), WilayahCuprimer::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            WilayahCuprimer::create($data);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Wilayah CU <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function update()
    {
        try{
            $validator = Validator::make($data = Input::all(), WilayahCuprimer::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $id = Input::get('id');
            $kelas = WilayahCuprimer::findOrFail($id);

            //simpan
            $kelas->update($data);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Wilayah cu  <b><i>' .$name. '</i></b> Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = WilayahCuprimer::find($id);

            if($kelas->hascuprimer->count() > 0) {
                WilayahCuprimer::destroy($id);
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Wilayah CU telah berhasil di hapus.');
            }else{
                return Redirect::back()->withInput()->with('errormessage','Maaf terdapat informasi CU pada wilayah ini, silahkan hapus informasi CU tersebut.');
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}