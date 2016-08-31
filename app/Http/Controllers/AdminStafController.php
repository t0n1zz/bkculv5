<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\Staf;
use App\Models\StafRiwayat;
use App\Models\Cuprimer;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class AdminStafController extends Controller{

    protected $kelaspath = 'staf';
    protected $imagepath = 'images_staf/';

    public function index()
    {
        try{
            $datas = Staf::with('cuprimer')->orderBy('cu','asc')->get();;
            $datas2 = Cuprimer::all();
            $isall = true;

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2','isall'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function allstaf(){
        return Datatables::of($datas = Staf::with('cuprimer')->orderBy('cu','asc')->get())->make(true);
    }

    public function index_bkcu()
    {
        try{
            $datas = Staf::with('cuprimer')->where('cu','=','0')
                    ->orderBy('cu','asc')->get();;
            $datas2 = Cuprimer::all();
            $isall = false;

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2','isall'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_cu($id)
    {
        try{
            $datas = Staf::with('cuprimer')->where('cu','=',$id)
                ->orderBy('cu','asc')->get();;
            $datas2 = Cuprimer::all();
            $isall = false;

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datas2','isall'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_public()
    {
        try{
            $datas = Staf::with('cuprimer')->where('cu','=',Auth::user()->cuprimer->id)
                ->orderBy('cu','asc')->get();;
            $datas2 = Cuprimer::all();
            $isall = false;

            return view('cu.kelola_staf', compact('datas','datas2','isall'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function detail($id)
    {
        try{
            $data = Staf::with('cuprimer')->find($id);
            $riwayats1 = StafRiwayat::where('id_staf','=',$id)->where('tipe','=',1)
                ->orderBy('selesai','dsc')->get();
            $riwayats2 = StafRiwayat::where('id_staf','=',$id)->where('tipe','=',3)
                ->orderBy('selesai','dsc')->get();
            $riwayats3 = StafRiwayat::where('id_staf','=',$id)->where('tipe','=',2)
                ->orderBy('selesai','dsc')->get();
            return view('admins.'.$this->kelaspath.'.detail', compact('data','riwayats1',
                'riwayats2','riwayats3'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function detail_public($id)
    {
        try{
            $idcu = Auth::user()->cuprimer->id;
            $data = Staf::with('cuprimer')->where('cu',$idcu)->find($id);
            if(!empty($data)) {
                $riwayats1 = StafRiwayat::where('id_staf', '=', $id)->where('tipe', '=', 1)
                    ->orderBy('selesai', 'dsc')->get();
                $riwayats2 = StafRiwayat::where('id_staf', '=', $id)->where('tipe', '=', 2)
                    ->orderBy('selesai', 'dsc')->get();
                $riwayats3 = StafRiwayat::where('id_staf', '=', $id)->where('tipe', '=', 3)
                    ->orderBy('selesai', 'dsc')->get();
                return view('cu.detail_staf', compact('data', 'riwayats1',
                    'riwayats2', 'riwayats3'));
            }else{

            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            $datas2 = Cuprimer::orderBy('name','asc')->get();;
            return view('admins.'.$this->kelaspath.'.create',compact('datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create_public()
    {
        try{
            $datas2 = Cuprimer::orderBy('name','asc')->get();;
            return view('cu.create_staf',compact('datas2'));
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

            Staf::create($data2);

            if(Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function riwayat()
    {
        try{

            $id = Input::get('id');
            $tipe = Input::get('tipe');
            $date1 = Input::get('mulai');
            $date2 = Input::get('selesai');

            if($id == "")
                $kelas = new StafRiwayat();
            else
                $kelas = StafRiwayat::findOrFail($id);

            $kelas->id_staf = Input::get('id_staf');
            $kelas->tipe = $tipe;
            $kelas->name = Input::get('name');
            $kelas->keterangan = Input::get('keterangan');
            $kelas->sekarang = Input::get('sekarang');

            if($tipe == '1')
                $kelas->keterangan2 = Input::get('tipependidikan');

            if(!empty($date1)){
                $timestamp = strtotime(str_replace('/', '-',$date1));
                $tanggal = date('Y-m-d',$timestamp);
                $kelas->mulai = $tanggal;
            }

            if(!empty($date2)){
                $timestamp = strtotime(str_replace('/', '-',$date2));
                $tanggal = date('Y-m-d',$timestamp);
                $kelas->selesai = $tanggal;
            }

            $kelas->save();

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Riwayat telah berhasil ditambah');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $data = Staf::find($id);
            $datas2 = Cuprimer::orderBy('name','asc')->get();;
            return view('admins.'.$this->kelaspath.'.edit', compact('data','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit_public()
    {
        try{
            $data = Staf::find(Auth::user()->cuprimer->id);
            $datas2 = Cuprimer::orderBy('name','asc')->get();;
            return view('cu.edit_staf', compact('data','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update($id)
    {
        try{
            $kelas = Staf::findOrFail($id);

            $validator = Validator::make($data = Input::all(), Staf::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $data2 = $this->input_data($kelas,$data,$name);

            $kelas->update($data2);

            //simpan
            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_riwayat()
    {
        try{
            $id = Input::get('id');
            $kelas = StafRiwayat::findOrFail($id);
            $kelas->id_staf = Input::get('id_staf');
            $kelas->tipe = Input::get('tipe');
            $kelas->name = Input::get('name');
            $kelas->keterangan = Input::get('keterangan');
            $kelas->keterangan2 = Input::get('keterangan2');
            $kelas->sekarang = Input::get('sekarang');
            $date1 = Input::get('mulai');
            if(!empty($date1)){
                $timestamp = strtotime(str_replace('/', '-',$date1));
                $tanggal = date('Y-m-d',$timestamp);
                $kelas->mulai = $tanggal;
            }
            $date2 = Input::get('selesai');
            if(!empty($date2)){
                $timestamp = strtotime(str_replace('/', '-',$date2));
                $tanggal = date('Y-m-d',$timestamp);
                $kelas->selesai = $tanggal;
            }

            $kelas->save();

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Riwayat telah berhasil diubah');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function input_data($kelas,$data)
    {
        //gambar
        try {
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

    public function destroy_public()
    {
        try{
            $id = Input::get('id');
            $kelas = Staf::findOrFail($id);
            $path = public_path($this->imagepath);


            File::delete($path . $kelas->gambar);
            File::delete($path. $kelas->gambar.".jpg");
            File::delete($path. $kelas->gambar."n.jpg");

            Staf::destroy($id);

            return Redirect::route('cu.kelola_staf')->with('sucessmessage', 'Staff Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy_riwayat()
    {
        try{
            $id = Input::get('id');
            StafRiwayat::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.detail',array(Input::get('id_staf')))->with('sucessmessage', 'Riwayat telah berhasil dihapus');
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