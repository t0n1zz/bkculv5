<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use File;
use Image; 
use Input;
use Redirect;
use Validator;
use App\Staf;
use App\StafPekerjaan;
use App\Cuprimer;
use App\Pemilihan;
use App\PemilihanCalon;
use App\PemilihanHub;
use \DOMDocument;
use App\Http\Requests;

class PemilihanController extends Controller{

    protected $kelaspath = 'pemilihan';

    public function index()
    {
        try{
            $datas = Pemilihan::get();
            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function calon($id){
        try{
            $cu = Auth::user()->getCU();
            $data = Pemilihan::find($id);
            $datas = PemilihanCalon::with('staf','cu','pemilihanhub')->where('id_pemilihan',$id)->get();
            $pemilih = PemilihanHub::where('id_cu',$cu);

            if($cu == 0)
                $datastaf = StafPekerjaan::with('cuprimer','staf.pendidikan_tertinggi')->where('sekarang','1')->orWhere('selesai','>',date('Y-m-d'))->get();
            else
                $datastaf = StafPekerjaan::with('cuprimer','staf.pendidikan_tertinggi')->where('id_tempat',$cu)->where('sekarang','1')->orWhere('selesai','>',date('Y-m-d'))->get();

            return view('admins.'.$this->kelaspath.'.calon', compact('data','datas','datastaf','pemilih'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Pemilihan::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $date = str_replace('/', '-', Input::get('mulai'));
            $tanggal=  date('Y-m-d', strtotime($date));
            array_set($data,'mulai',$tanggal);

            $date2 = str_replace('/', '-', Input::get('selesai'));
            $tanggal2=  date('Y-m-d', strtotime($date2));
            array_set($data,'selesai',$tanggal2);

            $pemilihan = Pemilihan::create($data);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Pemilihan <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_calon()
    {
        try{
            $pemilihan = Input::get('id_pemilihan');

            $kelas = new PemilihanCalon();
            $kelas->id_pemilihan = $pemilihan;
            $kelas->id_staf = Input::get('staf');
            $kelas->id_cu = Input::get('id_cu');
            $kelas->jabatan = Input::get('jabatan');

            $kelas->save();    
            
            return Redirect::route('admins.'.$this->kelaspath.'.calon',array($pemilihan))->with('sucessmessage', 'Calon telah berhasil didaftarkan');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_pilih()
    {
        try{
            $pemilihan = Input::get('id_pemilihan');

            $kelas = new PemilihanHub();
            $kelas->id_calon = Input::get('id_calon');
            $kelas->id_cu = Input::get('id_cu');

            $kelas->save();    
            
            return Redirect::route('admins.'.$this->kelaspath.'.calon',array($pemilihan))->with('sucessmessage', 'Calon telah berhasil dipilih');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update()
    {
        try{
            $validator = Validator::make($data = Input::all(), Pemilihan::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');
            $id = Input::get('id');
            $kelas = Pemilihan::findOrFail($id);

            $date = str_replace('/', '-', Input::get('mulai'));
            $tanggal=  date('Y-m-d', strtotime($date));
            array_set($data,'mulai',$tanggal);

            $date2 = str_replace('/', '-', Input::get('selesai'));
            $tanggal2=  date('Y-m-d', strtotime($date2));
            array_set($data,'selesai',$tanggal2);

            //simpan
            $kelas->update($data);
            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Pemilihan  <b><i>' .$name. '</i></b> Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');

            Pemilihan::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Pemilihan telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}