<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use File;
use Input;
use Redirect;
use Validator;
use App\Staf;
use App\StafKeluarga;
use App\StafAnggotaCU;
use App\StafBidang;
use App\StafBidangHub;
use App\StafPekerjaan;
use App\StafPendidikan;
use App\StafOrganisasi;
use App\Cuprimer;
use App\Lembaga;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class StafController extends Controller{

    protected $kelaspath = 'staf';
    protected $imagepath = 'images_staf/';

    public function index()
    {
        try{
            $id = '1';
            $datas = StafPekerjaan::with('staf')->where('tipe','3')->where('tempat','=',$id)->get();
            $datas2 = Cuprimer::select('id','name')->get();
            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2','id'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function allstaf(){
        // return Datatables::of($datas = Staf::with('cuprimer')->orderBy('cu','asc')->get())->make(true);
    }

    public function index_cu($id)
    {
        try{
            $datas = StafPekerjaan::with('staf')->where('tipe','1')->where('tempat','=',$id)->get();
            $datas2 = Cuprimer::all();

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2','id'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function detail($id)
    {
        try{
            $data = Staf::find($id);
            $riwayatpekerjaan = StafPekerjaan::where('id_staf','=',$id)->orderBy('selesai','dsc')->get();
            $riwayatpendidikan = StafPendidikan::with('cuprimer')->where('id_staf','=',$id)->orderBy('selesai','dsc')->get();
            $riwayatorganisasi = StafOrganisasi::where('id_staf','=',$id)->orderBy('selesai','dsc')->get();
            $keluargas = StafKeluarga::where('id_staf',$id)->get();
            $anggotacus = StafAnggotaCU::where('id_staf',$id)->get();
            $culists = Cuprimer::select('no_ba','name')->orderBy('name','asc')->get();
            $lembagas = Lembaga::select('id','name')->orderBy('name','asc')->get();
            return view('admins.'.$this->kelaspath.'.detail', compact('data','riwayatpekerjaan','riwayatpendidikan','riwayatorganisasi','culists','lembagas','keluargas','anggotacus'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            $culists = Cuprimer::orderBy('name','asc')->get();
            $lembagas = Lembaga::orderBy('name','asc')->get();
            return view('admins.'.$this->kelaspath.'.create',compact('culists','lembagas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Staf::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $kelas = new Staf();
            $data2 = $this->input_data($kelas,$data);
            $tiperadio = Input::get('tiperadio');
            $no_tipe = 0;
            $savedata = Staf::create($data2);
            $namaorganisasi = Input::get('namaorganisasi');
            $nameayah = Input::get('nameayah');
            $nameibu = Input::get('nameibu');
            $namepasangan = Input::get('namepasangan');
            $nameanaks = Input::get('nameanak');
            $namecus = Input::get('namecu');
            $nocus = Input::get('nocu');

            // anggota cu
            $i = 0;
            foreach ($namecus as $namecu) {
                if(!empty($nocus[$i])){
                    $this->input_anggotacu($savedata->id,null,$namecu,$nocus[$i]);
                }else{
                    $this->input_anggotacu($savedata->id,null,$namecu,null);
                }
                
                $i++;
            }

            // keluarga
            if(!empty($nameayah))
                $this->input_keluaga($savedata->id,null,$nameayah,'Ayah');
            
            if(!empty($nameibu))
                $this->input_keluaga($savedata->id,null,$nameibu,'Ibu');

            if(!empty($namepasangan))
                $this->input_keluaga($savedata->id,null,$namepasangan,'Pasangan');
   
            foreach ($nameanaks as $nameanak) {
                $this->input_keluaga($savedata->id,null,$nameanak,'Anak');
            }

            // riwayat
            $riwayatpekerjaan = $this->input_pekerjaan($savedata->id,null);
            $this->input_pendidikan($savedata->id,null);

            if(!empty($namaorganisasi))
                $this->input_organisasi($savedata->id,null);
            
            //nim
            $no_bkcu = sprintf("%'.03d", 15); //999
            $no_cu = sprintf("%'.03d", $riwayatpekerjaan[1]); //999
            $no_id = sprintf("%'.06d", $savedata->id); //999999
            $nim = $no_bkcu . $riwayatpekerjaan[0] . $no_cu  . $no_id;


            $kelasdata2 = Staf::find($savedata->id);
            $kelasdata2->nim = $nim;
            $kelasdata2->save();

            if(Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_lembaga()
    {
        $kelaslembaga = new Lembaga();
        $kelaslembaga->name = Input::get('namalembaga');
        $kelaslembaga->alamat = Input::get('alamatlembaga');
        $kelaslembaga->email = Input::get('emaillembaga');
        $kelaslembaga->telp = Input::get('telplembaga');
        $kelaslembaga->save();

        return $kelaslembaga->id;
    }

    public function save_riwayat()
    {
        try{
            $id_staf = Input::get('id_staf');
            $id_pekerjaan = Input::get('id_pekerjaan');
            $id_pendidikan = Input::get('id_pendidikan');
            $id_organisasi = Input::get('id_organisasi');
            $namapekerjaan = Input::get('namapekerjaan');
            $selectpendidikan = Input::get('selectpendidikan');
            $namaorganisasi = Input::get('namaorganisasi');
            $keterangan = "";
            $keterangan2 = "";

            if(!empty($id_pekerjaan)){
                $keterangan2 = "diubah";
            }else{
                $keterangan2 = "ditambah";
            }

            if(!empty($namapekerjaan)){
                $this->input_pekerjaan($id_staf,$id_pekerjaan);
                $keterangan = "pekerjaan";
            }

            if(!empty($selectpendidikan)){
                $this->input_pendidikan($id_staf,$id_pendidikan);
                $keterangan = "pendidikan";
            }

            if(!empty($namaorganisasi)){
                $this->input_organisasi($id_staf,$id_organisasi);
                $keterangan = "organisasi";
            }

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Riwayat '.$keterangan.' telah berhasil ' .$keterangan2);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function save_keluarga()
    {
        try{
            $id_staf = Input::get('id_staf');
            $id_keluarga = Input::get('id_keluarga');
            $namakeluarga = Input::get('namakeluarga');
            $tipekeluarga = Input::get('tipekeluarga');

            if(!empty($id_keluarga)){
                $keterangan2 = "diubah";
            }else{
                $keterangan2 = "ditambah";
            }

            $this->input_keluarga($id_staf,$id_keluarga,$namakeluarga,$tipekeluarga);

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Keluarga telah berhasil ' .$keterangan2);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function save_anggotacu()
    {
        try{
            $id_staf = Input::get('id_staf');
            $id_anggotacu = Input::get('id_anggotacu');
            $namecu = Input::get('namecu');
            $no_ba = Input::get('no_ba');

            if(!empty($id_anggotacu)){
                $keterangan2 = "diubah";
            }else{
                $keterangan2 = "ditambah";
            }

            $this->input_anggotacu($id_staf,$id_anggotacu,$namecu,$no_ba);

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Keanggotaan di CU telah berhasil ' .$keterangan2);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function input_data($kelas,$data)
    {
        //gambar
        try {
            $date1 = Input::get('tanggal_lahir');
            if(!empty($date1)){
                $timestamp = strtotime(str_replace('/', '-',$date1));
                $tanggal = date('Y-m-d',$timestamp);
                array_set($data,'tanggal_lahir',$tanggal);
            }

            $img = Input::file('gambar');
            $name = preg_replace('/[^A-Za-z0-9\-]/', '',Input::get('name'));
            $formatedname = $name.str_random(5).date('Y-m-d');
            if (!is_null($img)) {
                $filename = $formatedname.".jpg";

                if ($this->save_image($img, $kelas, $filename))
                    array_set($data,'gambar',$formatedname);
                else
                    return false;
            }else{
                $filename = $kelas->gambar;
                array_set($data,'gambar',$filename);
            }
        } catch (Exception $e) {
            $this->status = $e->getMessage();
        }

        return $data;
    }

    public function input_keluaga($id_staf,$id_keluarga)
    {
        if(!empty($id_keluarga)){
            $kelas = StafKeluarga::findOrFail($id_keluarga);
        }else{
            $kelas = new StafKeluarga();
        }
        
        $kelas->id_staf = $id_staf;
        $kelas->name = $namekeluarga;
        $kelas->tipe = $tipekeluarga;

        $kelas->save();
    }

    public function input_anggotacu($id_staf,$id_anggotacu,$namecu,$no_ba)
    {
        if(!empty($id_anggotacu)){
            $kelas = StafAnggotaCU::findOrFail($id_anggotacu);
        }else{
            $kelas = new StafAnggotaCU();
        }
        
        $kelas->id_staf = $id_staf;
        $kelas->name = $namecu;
        $kelas->no_ba = $no_ba;

        $kelas->save();
    }

    public function input_pekerjaan($id_staf,$id_pekerjaan)
    {
        $tipepekerjaan = Input::get('tipepekerjaan');
        $sekarang = Input::get('sekarangpekerjaan');
        $kelamin = Input::get('kelamin');

        if(!empty($id_pekerjaan)){
            $kelasriwayat = StafPekerjaan::findOrFail($id_pekerjaan);
        }else{
            $kelasriwayat = new StafPekerjaan();
        }
        
        $kelasriwayat->id_staf = $id_staf;
        $kelasriwayat->tipe = $tipepekerjaan;
        $kelasriwayat->name = Input::get('namapekerjaan');

        $no_tipe = 0;
        if($tipepekerjaan == "1"){//cu
            $kelasriwayat->bidang = Input::get('selectbidangcu');
            $kelasriwayat->tingkat = Input::get('selecttingkatcu');
            $kelasriwayat->tempat = Input::get('selectcu');
            $lembaga = Input::get('selectcu');

            if($kelamin == 'Pria')//no tipe utk nim
                $no_tipe = 1;
            else
                $no_tipe = 2;
        }elseif($tipepekerjaan == "2"){//lembaga lain
            $kelasriwayat->bidang = "";
            $kelasriwayat->tingkat = Input::get('selecttingkatlembaga');

            $selectlembaga = Input::get('selectlembaga');
            if($selectlembaga == "tambah"){// tambah lembaga
                $lembaga = $this->store_lembaga();
            }else{
                $lembaga = $selectlembaga;
            }
            $kelasriwayat->tempat = $lembaga;

            if($kelamin == 'Pria')//no tipe utk nim
                $no_tipe = 3;
            else
                $no_tipe = 4; 
        }elseif($tipepekerjaan == "3"){
            $kelasriwayat->bidang = Input::get('selectbidangcu');
            $kelasriwayat->tingkat = Input::get('selecttingkatcu');
            $kelasriwayat->tempat = 1;
            $lembaga = 1;

            if($kelamin == 'Pria')//no tipe utk nim
                $no_tipe = 5;
            else
                $no_tipe = 6;
        }

        $kelasriwayat->sekarang = $sekarang;

        $date1 = Input::get('mulaipekerjaan');
        $date2 = Input::get('selesaipekerjaan');
        if(!empty($date1)){
            $timestamp = strtotime(str_replace('/', '-',$date1));
            $tanggal = date('Y-m-d',$timestamp);
            $kelasriwayat->mulai = $tanggal;
        }
        if($sekarang != 1){
            if(!empty($date2)){
                $timestamp = strtotime(str_replace('/', '-',$date2));
                $tanggal = date('Y-m-d',$timestamp);
                $kelasriwayat->selesai = $tanggal;
            }
        }
        
        $kelasriwayat->save();

        $bidangs = Input::get('bidang');
        $bidangbaru = Input::get('bidangbaru');

        if(!empty($bidangbaru)){
            $kelasbidang = new StafBidang();
            $kelasbidang->name = $bidangbaru;
            $kelasbidang->save();

            array_push($bidangs,$kelasbidang->id);
        }

        if(!empty($bidangs) && !empty($id_pekerjaan)){
            StafBidangHub::where('id_pekerjaan',$id_pekerjaan)->delete(); 
        }

        foreach($bidangs as $bidang){
            $kelasbidang = new StafBidangHub();
            $kelasbidang->id_pekerjaan = $kelasriwayat->id;
            $kelasbidang->id_bidang = $bidang;
            $kelasbidang->save();
        }

        return array($no_tipe,$lembaga);
    }

    public function input_pendidikan($id_staf,$id_pendidikan)
    {
        if(!empty($id_pendidikan)){
            $kelasriwayat = StafPendidikan::findOrFail($id_pendidikan);
        }else{
            $kelasriwayat = new StafPendidikan();
        }

        $kelasriwayat->id_staf = $id_staf;
        $kelasriwayat->name = Input::get('namapendidikan');
        $kelasriwayat->tingkat = Input::get('selectpendidikan');
        $kelasriwayat->tempat = Input::get('tempatpendidikan');
        
        $kelasriwayat->sekarang = Input::get('sekarangpendidikan');
        $date1 = Input::get('mulaipendidikan');
        $date2 = Input::get('selesaipendidikan');
        if(!empty($date1)){
            $timestamp = strtotime(str_replace('/', '-',$date1));
            $tanggal = date('Y-m-d',$timestamp);
            $kelasriwayat->mulai = $tanggal;
        }
        if(!empty($date2)){
            $timestamp = strtotime(str_replace('/', '-',$date2));
            $tanggal = date('Y-m-d',$timestamp);
            $kelasriwayat->selesai = $tanggal;
        }
        $kelasriwayat->save();
    }

    public function input_organisasi($id_staf,$id_organisasi)
    {
        if(!empty($id_organisasi)){
            $kelasriwayat = StafOrganisasi::findOrFail($id_organisasi);
        }else{
            $kelasriwayat = new StafOrganisasi();
        }
        
        $kelasriwayat->id_staf = $id_staf;
        $kelasriwayat->name = Input::get('namaorganisasi');
        $kelasriwayat->jabatan = Input::get('jabatanorganisasi');
        $kelasriwayat->tempat = Input::get('tempatorganisasi');

        $kelasriwayat->sekarang = Input::get('sekarangorganisasi');
        $date1 = Input::get('mulaiorganisasi');
        $date2 = Input::get('selesaiorganisasi');
        if(!empty($date1)){
            $timestamp = strtotime(str_replace('/', '-',$date1));
            $tanggal = date('Y-m-d',$timestamp);
            $kelasriwayat->mulai = $tanggal;
        }
        if(!empty($date2)){
            $timestamp = strtotime(str_replace('/', '-',$date2));
            $tanggal = date('Y-m-d',$timestamp);
            $kelasriwayat->selesai = $tanggal;
        }
        $kelasriwayat->save();
}

    public function edit($id)
    {
        try{
            $data = Staf::find($id);
            $culists = Cuprimer::orderBy('name','asc')->get();
            $lembagas = Lembaga::orderBy('name','asc')->get();
            return view('admins.'.$this->kelaspath.'.edit', compact('data','culists','lembagas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update($id)
    {
        try{
            $kelas = Staf::findOrFail($id);

            $route = Input::get('route');

            if(empty($route)){
                $validator = Validator::make($data = Input::all(), Staf::$rules);
                if ($validator->fails())
                {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
            }else{
                $data = Input::all();
            }

            $name = Input::get('name');
            $data2 = $this->input_data($kelas,$data,$name);

            $kelas->update($data2);

            //simpan
            if (Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }else{
                if(empty($route)){
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                }else{
                    return Redirect::route($route,array($id))->with('sucessmessage', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                }
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = Staf::findOrFail($id);
            $path = public_path($this->imagepath);


            File::delete($path . $kelas->gambar);
            File::delete($path. $kelas->gambar.".jpg");
            File::delete($path. $kelas->gambar."n.jpg");

            Staf::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_riwayat()
    {
        try{
            $id = Input::get('id');
            $tipe = Input::get('tipehapus');

            if($tipe == "Pekerjaan"){
                StafPekerjaan::destroy($id);
                StafBidangHub::where('id_pekerjaan',$id)->delete();
            }elseif($tipe == "Pendidikan"){
                StafPendidikan::destroy($id);
            }elseif($tipe == "Organisasi"){
                StafOrganisasi::destroy($id);
            }

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Riwayat telah berhasil dihapus');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_keluarga()
    {
        try{
            $id = Input::get('idhapuskeluarga');
            StafKeluarga::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Keluarga telah berhasil dihapus');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_anggotacu()
    {
        try{
            $id = Input::get('idhapusanggotacu');
            StafAnggotaCU::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Anggota CU telah berhasil dihapus');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    function save_image($img,$kelas,$filename)
    {
        list($width, $height) = getimagesize($img);

        $path = public_path($this->imagepath);

        File::delete($path . $kelas->gambar);
        File::delete($path . $kelas->gambar .".jpg");
        File::delete($path . $kelas->gambar ."n.jpg");

        Image::make($img->getRealPath())->fit(249,289)->save($path . $filename);
    }
}