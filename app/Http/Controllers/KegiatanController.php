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
use App\StafPekerjaan;
use App\KegiatanTempat;
use App\KegiatanPrasyarat;
use App\KegiatanSasaran;
use App\KegiatanSasaranHub;
use App\Staf;
use App\Cuprimer;
use App\Kegiatan;
use App\KegiatanPanitia;
use App\KegiatanPeserta;
use \DOMDocument;
use App\Http\Requests;

class KegiatanController extends Controller{

    protected $kelaspath = 'kegiatan';
    protected $imagepath = "images_tempat/";

    public function index()
    {
        try{
            $datas = Kegiatan::withTrashed()->with('tempat','sasaranhub.sasaran','prasyarat.kegiatan','total_peserta')->get();
            // dd($datas[52]->sasaranhub);
            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_public()
    {
        try{
            $datas = Kegiatan::orderBy('status', 'asc')
                ->orderBy('name','asc')
                ->get();

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
                ->orderBy('cu','asc')->get();
            return view('cu.daftar_kegiatan', compact('data','datas'));
        }catch (Exception $e){
        return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function detail($id)
    {
        try{
            $tabname = "informasi";
            $cu = Auth::user()->getCU();

            $data = Kegiatan::with('sasaranhub.sasaran','prasyarat.kegiatan','tempat')->withTrashed()->find($id);
            $datapanitia = KegiatanPanitia::with('staf.pekerjaan_aktif.cuprimer')->where('id_kegiatan','=',$id)->get();
            $datapeserta = KegiatanPeserta::with(array('staf.pekerjaan_aktif.cuprimer' => function($query){
                $query->where('no_ba',Auth::user()->getCU());
            }))->where('id_kegiatan','=',$id)->get();

            if($cu == 0)
                $datastaf = StafPekerjaan::with('cuprimer','staf.pendidikan_tertinggi')->where('sekarang','1')->orWhere('selesai','>',date('Y-m-d'))->get();
            else
                $datastaf = StafPekerjaan::with('cuprimer','staf.pendidikan_tertinggi')->where('id_tempat',$cu)->where('sekarang','1')->orWhere('selesai','>',date('Y-m-d'))->get();

            return view('admins.'.$this->kelaspath.'.detail',compact('data','datasasaran','datatempat','datapanitia','datapeserta','datastaf','tabname'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function getselect2()
    {
        try{
            $q = Input::get('q');
            $repo = Staf::with('pekerjaan')->where('name','LIKE','%'.$q.'%')->get();

            return \Response::json($repo);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            $tempats = KegiatanTempat::get();
            $sasarans = KegiatanSasaran::get();
            $prasyarats = Kegiatan::select('id','kode','name')->get();
            return view('admins.'.$this->kelaspath.'.create',compact('sasarans','tempats','prasyarats'));
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

            // dd($data2);

            $savedata = Kegiatan::create($data2);

            $this->input_sasaran($savedata->id);
            $this->input_prasyarat($savedata->id);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan kegiatan.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_panitia()
    {
        try{
            $tabname = "pendaftaran";
            $kegiatan = Input::get('id_kegiatan');

            $kelas = new KegiatanPanitia();
            $kelas->id_kegiatan = $kegiatan;
            $kelas->id_panitia = Input::get('panitia');
            $kelas->tugas = Input::get('selecttugas');
            $kelas->keterangan = Input::get('keterangan');
            $kelas->status = 1;

            $kelas->save();    
            
            return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Peserta telah berhasil didaftarkan');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_peserta()
    {
        try{
            $tabname = "pendaftaran";
            $kegiatan = Input::get('id_kegiatan');
            $peserta = Input::get('peserta');

            foreach ($peserta as $p){
                $kelas = new KegiatanPeserta();
                $kelas->id_kegiatan = $kegiatan;
                $kelas->id_peserta = $p;
                $kelas->status = 1;

                $kelas->save();    
            }
            
            return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Peserta telah berhasil didaftarkan');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_tempat()
    {
        $kelas = new KegiatanTempat();
        $kelas->name = Input::get('nametempat');
        $kelas->keterangan = Input::get('keterangantempat');
        $kelas->kota = Input::get('kota');

        $img = Input::file('gambar');
        if (!is_null($img)) {
            $name = preg_replace('/[^A-Za-z0-9\-]/', '',Input::get('nametempat'));
            $formatedname = $name.str_random(5).date('Y-m-d');
            $filename = $formatedname.".jpg";
            $filename2 = $formatedname."n.jpg";

            $this->save_image($img, $kelas, $filename, $filename2);
            $kelas->gambar = $formatedname;
        }

        $kelas->save();

        return $kelas->id;
    }

    public function edit($id)
    {
        try{
            $data = Kegiatan::with('sasaranhub','tempat')->find($id);
            $tempats = KegiatanTempat::get();
            $sasarans = KegiatanSasaran::get();
            $prasyarats = Kegiatan::select('id','kode','name')->get();
            return view('admins.'.$this->kelaspath.'.edit', compact('data','tempats','sasarans','prasyarats'));
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

    public function update_status_peserta()
    {
        
        try{
            $id = Input::get('id');
            $id_status = Input::get('id_status');
            $kegiatan = Input::get('id_kegiatan');
            $radiostatus = Input::get('radiostatus');

            $kelas = KegiatanPeserta::find($id);
            $kelas->status = $radiostatus;
            $kelas->save();
            
            return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Status peserta telah berhasil diubah');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_ket_peserta()
    {
        
        try{
            $id = Input::get('id');
            $kegiatan = Input::get('id_kegiatan');
            $ketpeserta = Input::get('ketpeserta');
            
            $kelas = KegiatanPeserta::find($id);
            $kelas->keterangan = $ketpeserta;
            $kelas->save();
            
            return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Keterangan peserta telah berhasil diubah');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_tugas_panitia()
    {
        
        try{
            $id = Input::get('id');
            $id_tugas = Input::get('id_tugas');
            $kegiatan = Input::get('id_kegiatan');
            $radiotugas = Input::get('radiotugas');

            $kelas = KegiatanPanitia::find($id);
            $kelas->tugas = $radiotugas;
            $kelas->save();
            
            return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Tugas panitia telah berhasil diubah');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_ket_panitia()
    {
        
        try{
            $id = Input::get('id');
            $kegiatan = Input::get('id_kegiatan');
            $ketpanitia = Input::get('ketpanitia');
            
            $kelas = KegiatanPanitia::find($id);
            $kelas->keterangan = $ketpanitia;
            $kelas->save();
            
            return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Keterangan panitia telah berhasil diubah');
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

    public function update_tujuan(Request $request){
        try{
            $kelas = Kegiatan::find($request->id);
            $kelas->tujuan = $request->markup;
            $kelas->save();
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_pokok(Request $request){
        try{
            $kelas = Kegiatan::find($request->id);
            $kelas->pokok = $request->markup;
            $kelas->save();
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

        $periode = Input::get('periode');
        array_set($data,'periode',$periode);

        $min = Input::get('min');
        $max = Input::get('max');

        if(empty($min)){
            $min = 5;
            array_set($data,'min',$min);
        }

        if(empty($max)){
            $max = 20;
            array_set($data,'max',$max);
        }

        $selecttempat = Input::get('selecttempat');
        if($selecttempat == "tambah"){
            $tempat = $this->store_tempat();
        }elseif($selecttempat == "batal"){
            $tempat = null;
        }else{
            $tempat = $selecttempat;
        }

        if(!empty($tempat))
            array_set($data,'id_tempat',$tempat);

        if(!empty($tujuan)){
            $dom = new DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($tujuan, 'HTML-ENTITIES', "UTF-8"),LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            array_set($data, 'tujuan', $dom->saveHTML());
        }

        if(!empty($pokok)){
            $dom = new DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($pokok, 'HTML-ENTITIES', "UTF-8"),LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            array_set($data, 'pokok', $dom->saveHTML()); 
        }

        if(!empty($keterangan)){
            $dom = new DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($keterangan, 'HTML-ENTITIES', "UTF-8"),LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            array_set($data, 'keterangan', $dom->saveHTML()); 
        }

        return $data;
    }

    public function input_prasyarat($id_kegiatan)
    {
        $prasyarat = Input::get('prasyarat');
        if(!empty($prasyarat) && !empty($id_kegiatan)){
            KegiatanPrasyarat::where('id_prasyarat',$id_kegiatan)->delete();

            foreach($prasyarat as $pt){
                $kelas = new KegiatanPrasyarat();
                $kelas->id_prasyarat = $id_kegiatan;
                $kelas->id_kegiatan = $pt;
                $kelas->save();
            }
        }
    }

    public function input_sasaran($id_kegiatan)
    {
        $sasarans = Input::get('sasaran');
        if(!empty($sasarans) && !empty($id_kegiatan)){
            KegiatanSasaranHub::where('id_kegiatan',$id_kegiatan)->delete();

            foreach($sasarans as $sasaran){
                $kelassasaran = new KegiatanSasaranHub();
                $kelassasaran->id_kegiatan = $id_kegiatan;
                $kelassasaran->id_sasaran = $sasaran;
                $kelassasaran->save();
            }
        }
    }


    public function destroy()
    {
        try{
            $id = Input::get('id');
            $keterangan = Input::get('keterangan');

            if(!empty($keterangan)){
                $kelas = Kegiatan::find($id);
                $kelas->keterangan = $keterangan;
                $kelas->save();
            }
            
            Kegiatan::destroy($id);

        return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kegiatan ini telah dibatalkan.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function restore()
    {
        try{
            $id = Input::get('id');
            $kelas = Kegiatan::onlyTrashed()->findOrFail($id);

            $kelas->restore();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kegiatan telah dilanjutkan.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_panitia()
    {
        try{
            $id = Input::get('id');
            $kegiatan = Input::get('id_kegiatan');

            KegiatanPanitia::destroy($id);

        return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Panitia telah berhasil dihapus dari kegiatan');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_peserta()
    {
        try{
            $id = Input::get('id');
            $kegiatan = Input::get('id_kegiatan');

            KegiatanPeserta::destroy($id);

        return Redirect::route('admins.'.$this->kelaspath.'.detail',array($kegiatan))->with('sucessmessage', 'Peserta telah berhasil dihapus dari kegiatan');
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