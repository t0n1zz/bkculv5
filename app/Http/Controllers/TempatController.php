<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use File;
use Input;
use Image;
use Redirect;
use Validator;
use App\TpCU;
use App\KegiatanTempat;
use \DOMDocument;

class TempatController extends Controller{

    protected $kelaspath = 'tempat';
    protected $imagepath = 'images_tempat/';

    public function index()
    {
        try{
            $datas = KegiatanTempat::orderBy('name','asc')->get();

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas_non','datas2'));
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
            $validator = Validator::make($data = Input::all(), KegiatanTempat::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $kelas = new KegiatanTempat();
            $name = Input::get('name');
            $data2 = $this->input_gambar($kelas,$data);

            KegiatanTempat::create($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Tempat <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Tempat <b><i>' . $name . '</i></b> Telah berhasil ditambah.');

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan CU.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            
            $data = KegiatanTempat::where('id','=',$id)->first();

            return view('admins.'.$this->kelaspath.'.edit', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function update($id)
    {
        try{
            //get php max file upload size
            $file_max = ini_get('upload_max_filesize');
            $file_max_str_leng = strlen($file_max);
            $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
            $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
            $file_max = substr($file_max,0,$file_max_str_leng - 1);
            $file_max = intval($file_max);

            //validasi
            $validator = Validator::make($data = Input::all(), KegiatanTempat::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $kelas = KegiatanTempat::findOrFail($id);
            $data2 = $this->input_gambar($kelas,$data);

            $kelas->update($data2);


            if (Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Tempat <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }else{
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Tempat <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }

        }catch (Exception $e){
            if($e->getMessage() == "getimagesize(): Filename cannot be empty")
                return Redirect::back()->withInput()->with('errormessage','Pastikan ukuran file gambar tidak lebih besar dari ' .$file_max. ' ' .$file_max_meassure_unit);
            else
                return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function input_gambar($kelas,$data)
    {
        //gambar
        $name = preg_replace('/[^A-Za-z0-9\-]/', '',Input::get('name'));
        $formatedname = $name.str_random(5).date('Y-m-d');
        $img = Input::file('gambar');
        if (!is_null($img)) {

            $filename = $formatedname.".jpg";
            $filename2 = $formatedname."n.jpg";

            $this->save_image($img, $kelas, $filename,$filename2);
            array_set($data,'gambar',$formatedname);
        }else{
            $filename = $kelas->gambar;
            array_set($data,'gambar',$filename);
        }

        return $data;
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');

            KegiatanTempat::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Tempat telah dinon-aktifkan.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    function save_image($img,$kelas,$filename,$filename2)
    {
        list($width, $height) = getimagesize($img);

        $path = public_path($this->imagepath);

        File::delete($path . $kelas->gambar .".jpg");
        File::delete($path . $kelas->gambar ."n.jpg");

        if($width > 720){
            Image::make($img->getRealPath())->resize(720, null,
                function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path . $filename);
        }else{
            Image::make($img->getRealPath())->save($path . $filename);
        }

        Image::make($img->getRealPath())->fit(288,200)->save($path . $filename2);
    }
}