<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\TpCU;
use App\Models\Cuprimer;
use App\Models\WilayahCuprimer;
use \DOMDocument;

class CuprimerController extends Controller{

    protected $kelaspath = 'cuprimer';
    protected $imagepath = 'images_cu/';

    public function index()
    {
        try{
            $datas = Cuprimer::with('WilayahCuprimer')
                ->where('status','=','1')
                ->orderBy('name','asc')
                ->get();

            $datas_non = Cuprimer::with('WilayahCuprimer')
                ->where('status','=','0')
                ->orderBy('name','asc')
                ->get();


            $datas2 = WilayahCuprimer::all();

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas_non','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_wilayah($id)
    {
        try{
            $datas = Cuprimer::with('WilayahCuprimer')
                ->where('wilayah','=', $id)
                ->orderBy('name','asc')
                ->get();

            $datas2 = WilayahCuprimer::all();
            $is_wilayah = true;
            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2','is_wilayah'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function detail($id){
        try {
            $cu = Auth::user()->getCU();

            if($cu > 0){
                if($cu != $id)
                    return Redirect::back();
            }

            $data = Cuprimer::with('wilayahcuprimer')->where('no_ba','=',$id)->first();

            return view('admins.'.$this->kelaspath.'.detail', compact('data','id'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            $datas2 = WilayahCuprimer::orderBy('name','asc')->get();
            return view('admins.'.$this->kelaspath.'.create',compact('datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Cuprimer::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $kelas = new Cuprimer();
            $name = Input::get('name');

            $data2 = $this->input_wilayah($data);
            $data2 = $this->input_tanggal($data2);
            $data2 = $this->input_content($data2);
            $data2 = $this->input_gambar($kelas,$data2);

            Cuprimer::create($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan CU.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_wilayah()
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

    public function edit($id)
    {
        try {
            $cu = Auth::user()->getCU();

            if($cu > 0){
                if($cu != $id)
                    return Redirect::back();
            }
            
            $data = Cuprimer::where('no_ba','=',$id)->first();
            $datas2 = WilayahCuprimer::orderBy('name', 'asc')->get();

            return view('admins.'.$this->kelaspath.'.edit', compact('data', 'datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit_info_public()
    {
        try {

            $data = Cuprimer::find(Auth::user()->cuprimer->id);

            return view('cu.edit_info', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit_deskripsi_public()
    {
        try {

            $data = Cuprimer::find(Auth::user()->cuprimer->id);

            return view('cu.edit_deskripsi', compact('data'));
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
            $validator = Validator::make($data = Input::all(), Cuprimer::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $kelas = Cuprimer::findOrFail($id);
            $data2 = $this->input_wilayah($data);
            $data2 = $this->input_tanggal($data2);
            $data2 = $this->input_content($data2);
            $data2 = $this->input_gambar($kelas,$data2);

            $kelas->update($data2);

            $cu = \Auth::user()->getCU();

            if (Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }else{
                if($cu == '0')
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.'.$this->kelaspath.'.detail',array($cu))->with('sucessmessage', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }

        }catch (Exception $e){
            if($e->getMessage() == "getimagesize(): Filename cannot be empty")
                return Redirect::back()->withInput()->with('errormessage','Pastikan ukuran file gambar tidak lebih besar dari ' .$file_max. ' ' .$file_max_meassure_unit);
            else
                return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_status()
    {
        try{
            $id = Input::get('id');
            $kelas = Cuprimer::findOrFail($id);
            $name = $kelas->name;
            $status = $kelas->status;

            if($status == 1) {
                $statusname = "non-aktifkan";
                $kelas->status = 0;
            }else{
                $statusname = "diaktifkan";
                $kelas->status = 1;
            }

            $kelas->update();
            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Status CU  <b><i>' . $name . '</i></b> telah <b>' . $statusname . '</b>.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_deskripsi($id)
    {
        try{
            $kelas = Cuprimer::findOrFail($id);
            $name = $kelas->name;
            $data = Input::all();
            $data2 = $this->input_content($data); 

            $kelas->update($data2);

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array($id))->with('sucessmessage', 'Profil CU <b>' .$name. '</b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_wilayah()
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

    public function input_wilayah($data)
    {
        $wilayah = Input::get('wilayah');

        //kategori
        if($wilayah == "tambah"){
            $wilayahcuprimer = new WilayahCuprimer();
            $wilayahcuprimer->name = Input::get('wilayah_baru');
            $wilayahcuprimer->save();
            $last_id = $wilayahcuprimer->id;
            array_set($data,'wilayah',$last_id);
        }else {
            if(!empty($wilayah))
                array_set($data,'wilayah',$wilayah);
        }

        return $data;
    }

    public function input_tanggal($data)
    {
        $date1 = Input::get('bergabung');
        if(!empty($date1)){
            $timestamp = strtotime(str_replace('/', '-',$date1));
            $tanggal = date('Y-m-d',$timestamp);
            array_set($data,'ultah',$tanggal);
        }

        $date2 = Input::get('bergabung');
        if(!empty($date2)){
            $timestamp2 = strtotime(str_replace('/', '-',$date2));
            $tanggal2 = date('Y-m-d',$timestamp2);
            array_set($data,'bergabung',$tanggal2);
        }

        return $data;
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

    public function input_content($data)
    {
        $content = Input::get('deskripsi');

        if(!empty($content)){
            $array1 = array();
            $array2 = array();

            $dom = new DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"),LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach($images as $img) {
                $src = $img->getAttribute('src');
                $array1[]=$src;
                if(preg_match('/data:image/',$src)){
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    $filepath = "/images_artikel/$formatedname.$mimetype";

                    $image = Image::make($src)
                        ->encode($mimetype, 100)->widen(848,function($constraint){
                            $constraint->upsize();
                        })->save(public_path($filepath));

                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                }
            }

            if(!empty($kelas->content)) {
                $dom2 = new DomDocument();
                libxml_use_internal_errors(true);
                $dom2->loadHTML(mb_convert_encoding($kelas->content, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images2 = $dom2->getElementsByTagName('img');

                foreach ($images2 as $img2) {
                    $src2 = $img2->getAttribute('src');
                    $array2[] = $src2;
                }
                $result4 = array_diff($array2, $array1);
                foreach ($result4 as $imgarray) {
                    $path = public_path($this->imagepath);
                    File::delete($path . substr($imgarray,-24));
                }
            }

            array_set($data, 'content', $dom->saveHTML());
        }

        return $data;
    }

    public function destroy()
    {
        try{
        $id = Input::get('id');

        Cuprimer::destroy($id);

        return Redirect::route('admins.'.$this->kelaspath.'.index')->with('message', 'Informasi kegiatan telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_wilayah()
    {
        try{
            $id = Input::get('id');
            $kelas = WilayahCuprimer::find($id);

            if($kelas->hascuprimer->count() > 0)
                return Redirect::back()->withInput()->with('errormessage','Maaf terdapat informasi CU pada wilayah ini, silahkan hapus informasi CU tersebut.');

            WilayahCuprimer::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Wilayah CU telah berhasil di hapus.');
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