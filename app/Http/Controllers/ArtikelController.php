<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Image; 
use File;
use Redirect;
use Datatables;
use Validator;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use \DOMDocument;
use Jenssegers\Date\Date;

class ArtikelController extends Controller{

    protected $kelaspath = 'artikel';
    protected $imagepath = 'images_artikel/';
    /**
     * Display a listing of artikels
     *
     * @return Response
     */
    public function index()
    {
        try{
            $datakelas = Artikel::with('kategoriartikel')
                ->orderBy('judul','asc')
                ->get();
            
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();

            $i = 0;
            foreach ($datakelas as $data) {
                $date = new Date($data->created_at);
                $date2 = new Date($data->updated_at);
                $status = $this->check_empty($data->status,'0');
                $pilihan = $this->check_empty($data->pilihan,'0');
                if($status == 0){ $status = 'Tidak'; }elseif($status == 1){ $status = 'Ya'; };
                if($pilihan == 0){ $pilihan = 'Tidak'; }elseif($pilihan == 1){ $pilihan = 'Ya'; };

                $datas[$i] = array(
                    'id' => $this->check_empty($data->id,'-'),
                    'judul' => $this->check_empty($data->judul,'-'),
                    'kategori' => $this->check_empty($data->kategoriartikel->name,'Tak Terkategori'),
                    'penulis' => $this->check_empty($data->penulis,'-'),
                    'created_at' => $this->check_empty($date->format('d/n/Y'),'-'),
                    'updated_at' => $this->check_empty($date2->format('d/n/Y'),'-'),
                    'status' => $this->check_empty($status,'Tidak'),
                    'pilihan' => $this->check_empty($pilihan,'Tidak'),
                    'gambar' => $this->check_empty($data->gambar,''),
                );
                $i
            }

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_kategori($id)
    {
        try{
            $datas = Artikel::with('kategoriartikel')->where('kategori','=', $id)->get();
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();
            $is_kategori = true;

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2','is_kategori'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new artikel
     *
     * @return Response
     */
    public function create()
    {
        try{
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();

            return view('admins.'.$this->kelaspath.'.create', compact('datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }

    }

    /**
     * Store a newly created artikel in storage.
     *
     * @return Response
     */
    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Artikel::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $judul = Input::get('judul');

            $kelas = new Artikel;
            $data2 = $this->input_data($kelas,$data);

            Artikel::create($data2);

            if(Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Artikel <b>' .$judul. '</b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Artikel <b>' .$judul. '</b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_kategori()
    {
        try{
            $validator = Validator::make($data = Input::all(), KategoriArtikel::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            KategoriArtikel::create($data);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kategori Artikel <b><i>' .$name.
                                                                         '</i></b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified artikel.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try{
            $data = Artikel::find($id);
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();

            return view('admins.'.$this->kelaspath.'.edit', compact('data','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Update the specified artikel in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try{
            $file_max = ini_get('upload_max_filesize');
            $file_max_str_leng = strlen($file_max);
            $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
            $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
            $file_max = substr($file_max,0,$file_max_str_leng - 1);
            $file_max = intval($file_max);

            $kelas = Artikel::findOrFail($id);

            $validator = Validator::make($data = Input::all(), Artikel::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $judul = Input::get('judul');
            $data2 = $this->input_data($kelas,$data);
            $kelas->update($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Artikel <b>' . $judul . '</b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Artikel <b>' . $judul . '</b> Telah berhasil diubah.');
        }catch (Exception $e){
            if($e->getMessage() == "getimagesize(): Filename cannot be empty")
                return Redirect::back()->withInput()->with('errormessage','Pastikan ukuran file gambar tidak lebih besar dari ' .$file_max. ' ' .$file_max_meassure_unit);
            else
                return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_kategori()
    {
        try{
            $validator = Validator::make($data = Input::all(), KategoriArtikel::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $id = Input::get('id');
            $kelas = KategoriArtikel::findOrFail($id);

            $kelas->update($data);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kategori artikel  <b><i>' .$name.
                                                                            '</i></b> Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function input_data($kelas,$data)
    {
        $kategori = Input::get('kategori');

        if($kategori == "tambah"){
            $KategoriArtikel = new KategoriArtikel;
            $KategoriArtikel->name = Input::get('kategori_baru');
            $KategoriArtikel->save();
            $last_id = $KategoriArtikel->id;
            array_set($data,'kategori',$last_id);
        }else{
            array_set($data,'kategori',$kategori);
        }

        //gambar
        $gambarutama = Input::get('gambarutama');
        $judul = str_limit(preg_replace('/[^A-Za-z0-9\-]/', '',Input::get('judul')),30);
        $formatedname = $judul.str_random(10);
        if ($gambarutama == 1) {
            $img = Input::file('gambar');
            if (!is_null($img)) {
                $filename = $formatedname.".jpg";
                $filename2 = $formatedname."n.jpg";
                $filename3 = $formatedname."b.jpg";

                $this->save_image($img, $kelas, $filename,$filename2,$filename3);
                array_set($data, 'gambar', $formatedname);
            } else {
                $filename = $kelas->gambar;
                array_set($data, 'gambar', $filename);
            }
        } else {
            if (!empty($kelas->gambar)) {
                $path = public_path($this->imagepath);
                File::delete($path . $kelas->gambar);
                array_set($data, 'gambar', "");
            }
            array_set($data, 'gambar', "");
        }

        $content = Input::get('content');

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

    public function update_artikel_kategori()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $newkategori = Input::get('kategori');
            $kelas->kategori = $newkategori;
            $judul = $kelas->judul;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kategori artikel <b>' .$judul. '</b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_status()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $judul = $kelas->judul;

            if($kelas->status == "0")
                $kelas->status = 1;
            else
                $kelas->status = 0;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Status publikasi artikel <b>' .$judul. '</b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_pilihan()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $judul = $kelas->judul;

            if($kelas->pilihan == "0")
                $kelas->pilihan = 1;
            else
                $kelas->pilihan = 0;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Status artikel pilihan <b>' .$judul. '</b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Remove the specified artikel from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $path = public_path($this->imagepath);

            File::delete($path . $kelas->gambar);
            File::delete($path . $kelas->gambar .".jpg");
            File::delete($path . $kelas->gambar ."n.jpg");
            File::delete($path . $kelas->gambar ."b.jpg");

            Artikel::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Artikel Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_kategori()
    {
        try{
            $id = Input::get('id');
            $kelas = KategoriArtikel::find($id);

            if($kelas->hasartikel->count() > 0)
                return Redirect::back()->withInput()->with('errormessage','Masih terdapat artikel pada kategori ini,
                                                            silahkan dihapus terlebih dahulu.');

            KategoriArtikel::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kategori artikel telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    function save_image($img,$kelas,$filename,$filename2,$filename3)
    {
        list($width, $height) = getimagesize($img);

        $path = public_path($this->imagepath);

        File::delete($path . $kelas->gambar);
        File::delete($path . $kelas->gambar .".jpg");
        File::delete($path . $kelas->gambar ."n.jpg");
        File::delete($path . $kelas->gambar ."b.jpg");

        Image::make($img->getRealPath())->fit(848,636)->save($path . $filename);
        Image::make($img->getRealPath())->fit(360,240)->save($path . $filename2);
        Image::make($img->getRealPath())->fit(1220,424)->save($path . $filename3);
    }

    function save_image_article($img,$kelas,$filename)
    {
        list($width, $height) = getimagesize($img);

        $path = public_path($this->imagepath);

        File::delete($path . $kelas->gambar);
        File::delete($path . $kelas->gambar .".jpg");
        File::delete($path . $kelas->gambar ."n.jpg");
        File::delete($path . $kelas->gambar ."b.jpg");

        Image::make($img->getRealPath())->widen(848,function($constraint){
            $constraint->upsize();
        })->save($path . $filename);
    }

    function check_empty($value,$evalue){
        $value_checked = !empty($value) ? $value : $evalue;
        return $value_checked;
    }
}