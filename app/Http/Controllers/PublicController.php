<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use DB;
use Jenssegers\Date\Date;
use Response;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\Cuprimer;
use App\Models\Kegiatan;
use App\Models\KantorPelayanan;
use App\Models\Staf;
use App\Models\WilayahCuprimer;
use App\Models\Download;
use App\Models\Pelayanan;


class PublicController extends Controller{

    public function index(){

        $artikelpilihans = Artikel::where('pilihan', '=', '1')->get();

        $beritaBKCUs = Artikel::with('KategoriArtikel')
            ->where('status','=','1')
            ->orderBy('created_at', 'desc')
            ->take(3)->get();

        $cuprimers = Cuprimer::with('WilayahCuprimer')
                    ->orderBy(DB::raw('RAND()'))->get();

        $date = Date::now()->format('d-m');
        $query = "SELECT  id,name FROM cuprimer WHERE DATE_FORMAT(ultah, '%d-%m') = '$date' ";
        $ultahcu = DB::select(DB::raw($query));

        /*
        echo '<pre>';
        var_dump($gambars); // <---- or toJson()
        echo '</pre>';
        */

        return view('index',compact(
            'artikelpilihans','beritaBKCUs','cuprimers','ultahcu'
        ));
    }

    public function saran(){
        $validator = Validator::make($data = Input::all(), Saran::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $ip= $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Ymd");
        array_set($data,'ip',$ip);
        array_set($data,'tanggal',$tanggal);


        if(Saran::create($data))
            return Redirect::back();
    }

    public function artikel($id){
        if($id == 0){
            $artikels = Artikel::with('KategoriArtikel')
                ->where('status', '=', '1')
                ->whereNotIn('kategori', array('1','4','8'))
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }else {
            $artikels = Artikel::with('KategoriArtikel')
                ->where('kategori', '=', $id)
                ->where('status', '=', '1')
                ->whereNotIn('kategori', array('1'))
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            $kategori = KategoriArtikel::find($id);
            $title = $kategori->name;
        }
        $title = "Semua Berita";

        return view('artikel',compact('artikels','title'));
    }

    public function artikel_detail($id){
        $detail_artikel = Artikel::with('KategoriArtikel')
            ->where('status','=','1')
            ->find($id);

        $kategoris = KategoriArtikel::whereNotIn('id', array('1'))
                    ->orderBy('name','asc')->get();

        $artikelbarus = Artikel::select('id','judul','gambar','created_at')
            ->where('status','=','1')
            ->whereNotIn('kategori',array('1','8'))
            ->orderBy('created_at','desc')
            ->take(5)->get();

        return view('artikel_detail',compact('detail_artikel','artikelbarus','kategoris'));
    }

    public function filosofi(){
        $datas = $this->artikel(4);


        return view('artikel',compact('datas'));
    }

    public function pelayanan(){
        $pelayanans = Pelayanan::select('id','name','gambar','content')->get();

        return view('pelayanan',compact('pelayanans'));
    }

    public function agenda(){
        $kegiatans = Kegiatan::where('status','=','0')->orderBy('tanggal','asc')->get();

//        Flickering::handshake();
//        $gambar =  Flickering::callMethod('people.getPhotos', array('user_id' => '127271987@N07'));
//        $gambar->setPerPage(20);
//        $gambars = $gambar->getResults('photo');

        return view('agenda',compact('kegiatans'));
    }

    public function profil(){
        $kantor_pelayanans = KantorPelayanan::all();
        $visi = Artikel::where("id",'=','4')->first();

        return view('profil',compact('kantor_pelayanans','visi'));
    }

    public function pengurus(){
        $penguruses1 = Staf::where('tingkat','=','1')
            ->where('cu','=','0')
            ->where('periode1','=','2012')
            ->where('periode2','=','2014')
            ->get();
        $penguruses2 = Staf::where('tingkat','=','1')
            ->where('cu','=','0')
            ->where('periode1','=','2015')
            ->where('periode2','=','2017')
            ->get();

        return view('pengurus',compact('penguruses1','penguruses2'));
    }

    public function pengawas(){
        $pengawases1 = Staf::where('tingkat','=','2')
            ->where('cu','=','0')
            ->where('periode1','=','2012')
            ->where('periode2','=','2014')
            ->get();
        $pengawases2 = Staf::where('tingkat','=','2')
            ->where('cu','=','0')
            ->where('periode1','=','2015')
            ->where('periode2','=','2017')
            ->get();

        return view('pengawas',compact('pengawases1','pengawases2'));
    }

    public function manajemen(){
        $manajemens = Staf::where('tingkat','=','3')
            ->where('cu','=','0')
            ->get();

        return view('manajemen',compact('manajemens'));
    }

    public function sejarah(){
        $sejarahs = Artikel::where('kategori','=','8')->get();

        return view('sejarah',compact('sejarahs'));
    }

    public function cuprimer(){
        $jejarings = WilayahCuprimer::with('Cuprimer')
                    ->orderBy('name','asc')
                    ->get();

        return view('cuprimer',compact('jejarings'));
    }

    public function cuprimer_detail($id){
        $cudetail = Cuprimer::with('wilayahcuprimer')
                            ->where('id','=',$id)
                            ->first();

        $stafs = Staf::where('cu','=',$id)->get();

        return view('cuprimer_detail',compact('cudetail','stafs'));
    }

    public function hymnecu(){
        return view('hymne');
    }

    public function attribution(){
        return view('attribution');
    }

    public function sitemap($region){
        echo $region;
    }

    public function download(){
        $downloads = Download::all();

        return view('download',compact('downloads'));
    }

    public function download_file($filename){
        $destinationPath = public_path() . "/files/";
        $file= $destinationPath . $filename;

        return Response::download($file);
    }

    public function getcari(){
        $key = Input::get('q');
        $artikels = Artikel::where('judul','LIKE','%' .$key. '%')->where('status','=',1)->paginate(12);

        return view('cari', compact('artikels','key'));
    }

    public function update_kegiatan(){
        $now = new Date('now');
        $now->format('Y-m-d H:i:s');
        $kegiatans = kegiatan::where('tanggal2','<',$now)->get();

        foreach($kegiatans as $kegiatan){
            $kegiatan->status = "1";
            $kegiatan->update();
        }
    }

    public function pemilihan(){
        return view('pemilihan');
    }

    public function cu(){
        return view('cu.index');
    }
}