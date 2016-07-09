<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\Admin;
use App\Models\Kegiatan;

class AdminKegiatanController extends Controller{

    protected $kelaspath = 'kegiatan';

    public function index()
    {
        try{
            $datas = Kegiatan::with('Admin')
                        ->orderBy('status', 'asc')
                        ->orderBy('name','asc')
                        ->get();;
            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_public()
    {
        try{
            $datas = Kegiatan::with('Admin')
                ->orderBy('status', 'asc')
                ->orderBy('name','asc')
                ->get();;
            return view('cu.kelola_kegiatan', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function daftar_kegiatan($id)
    {
        try{
            $data = Kegiatan::find($id);
            $datas = Staf::with('cuprimer')->where('cu','=',Auth::user()->cuprimer->id)
                ->orderBy('cu','asc')->get();;
            return view('cu.daftar_kegiatan', compact('data','datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function detail()
    {
        return view('admins.'.$this->kelaspath.'.detail');
    }

    public function create()
    {
        try{
            return view('admins.'.$this->kelaspath.'.create');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Kegiatan::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $data2 = $this->input_data($data);

            Kegiatan::create($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan kegiatan.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $data = Kegiatan::find($id);

            return view('admins.'.$this->kelaspath.'.edit', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update($id)
    {
        try{
            $validator = Validator::make($data = Input::all(), Kegiatan::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $kegiatan = Kegiatan::findOrFail($id);
            $data2 = $this->input_data($data);

            $kegiatan->update($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_mulai(){
        try{
            $id = Input::get('id');
            $kelas = Kegiatan::findOrFail($id);

            $timestamp = strtotime(Input::get('tanggal'));
            $tanggal = date('Y-m-d',$timestamp);
            $kelas->tanggal = $tanggal;

            $name = $kelas->name;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Tanggal mulai kegiatan <b><i>' .$name. '</i></b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_selesai(){
        try{
            $id = Input::get('id');
            $kelas = Kegiatan::findOrFail($id);

            $timestamp = strtotime(Input::get('tanggal'));
            $tanggal = date('Y-m-d',$timestamp);
            $kelas->tanggal2 = $tanggal;

            $name = $kelas->name;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Tanggal selesai kegiatan <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function input_data($data)
    {
        $date = str_replace('/', '-', Input::get('tanggal'));
        $tanggal=  date('Y-m-d', strtotime($date));
        array_set($data,'tanggal',$tanggal);

        $date2 = str_replace('/', '-', Input::get('tanggal2'));
        $tanggal2=  date('Y-m-d', strtotime($date2));
        array_set($data,'tanggal2',$tanggal2);

        return $data;
    }

    public function destroy()
    {
        try{
        $id = Input::get('id');

        Kegiatan::destroy($id);

        return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Informasi kegiatan telah berhasil di hapus.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}