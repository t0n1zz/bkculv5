<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Download;

class DownloadController extends Controller {

    protected $kelaspath = 'download';

    public function index()
    {
        try{
            $datas = Download::orderBy('name','asc')->get();;
            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
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
            $validator = Validator::make($data = Input::all(), Download::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $kelas = new Download();
            $file = Input::file('upload');

            if(!empty($file)) {

                $extension = $file->getClientOriginalExtension();
                $name = Input::get('name');
                $string = str_random(20);
                $filename = Date::now()->format('d_m_Y_H_i_s_') . preg_replace('/\s+/', '', $string) . "." . $extension;
                $destinationPath = public_path() . "/files/";

                Input::file('upload')->move($destinationPath, $filename);

                $kelas->name = $name;
                $kelas->filename = $filename;
                $kelas->ekstensi = $extension;
                $kelas->save();

                if (Input::Get('simpan2'))
                    return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'File <b><i>' . $name . '</i></b> telah berhasil ditambah.');
                else
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'File <b><i>' . $name . '</i></b> telah berhasil ditambah.');
            }else{
                return Redirect::back()->withInput()->with('errormessage','Anda belum memilih file apa pun.');
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $data = Download::find($id);

            return view('admins.'.$this->kelaspath.'.edit', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update()
    {
        try{
            $id = Input::get('id');
            $validator = Validator::make($data = Input::all(), Download::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $kelas = Download::findOrFail($id);

            $kelas->update($data);

            return Redirect::route('admins.download.index')->with('sucessmessage', 'Nama file telah berhasil diubah.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = Download::where('id','=',$id)->first();

            $destinationPath = public_path() . "/files/";
            $filename = $destinationPath . $kelas->filename;

            if(!empty($filename) && is_file($filename)) {
                if (File::delete($filename)) {
                    if (Download::destroy($id))
                        return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'File telah berhasil di hapus.');
                }
            }else{
                if (Download::destroy($id))
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'File telah berhasil di hapus.');
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}