<?php
namespace App\Http\Controllers;

use Input;
use Auth;
use File;
use Image; 
use Redirect;
use Validator;
use App\Models\TpCU;
use App\Models\Cuprimer;

class TpcuController extends Controller{

    protected $kelaspath = 'tpcu';
    protected $imagepath = 'images_tpcu/';
    /**
     * Display a listing of artikels
     *
     * @return Response
     */
    public function index()
    {
        try{
            $datas = TpCU::with(['cuprimer' => function($query){
                $query->where('status','1');
            }])->orderBy('cu','desc')->get();

            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_cu($id){
        try{
            $cu = Auth::user()->getCU();

            if($cu > 0){
                if($cu != $id)
                    return Redirect::back();
            }

            $datas = TpCU::with('cuprimer')
                ->where('cu','=',$id)->orderBy('name','desc')->get();

            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
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
            $datas2 = Cuprimer::orderBy('name','asc')->get();;

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
            $validator = Validator::make($data = Input::all(), TpCU::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $cu = \Auth::user()->getCU();
            if($cu != '0'){
                array_set($data,'cu',$cu);
            }

            $kelas = new TpCU();
            $date = Input::get('ultah');
            if(!empty($date)){
                $timestamp2 = strtotime(str_replace('/', '-',$date));
                $tanggal2 = date('Y-m-d',$timestamp2);
                array_set($data,'ultah',$tanggal2);
            }

            $data = $this->input_gambar($kelas,$data);

            TpCU::create($data);

            if(Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage','TP CU Telah berhasil ditambah.');
            }else{
                if($cu == '0')
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','TP CU Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.tpcu.index_cu',array($cu))->with('sucessmessage','TP CU Telah berhasil ditambah.');
            }
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
            $data = TpCU::find($id);
            $datas2 = Cuprimer::orderBy('name','asc')->get();;

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
            $kelas = TpCU::findOrFail($id);

            $validator = Validator::make($data = Input::all(), TpCU::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $date = Input::get('ultah');
            if(!empty($date)){
                $timestamp2 = strtotime(str_replace('/', '-',$date));
                $tanggal2 = date('Y-m-d',$timestamp2);
                array_set($data,'ultah',$tanggal2);
            }
            $data = $this->input_gambar($kelas,$data);
            $kelas->update($data);

            if(Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage','TP CU Telah berhasil diubah.');
            }else{
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','TP CU Telah berhasil diubah.');
            }
        }catch (Exception $e){
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
            $kelas = TpCU::findOrFail($id);
            $path = public_path($this->imagepath);

            File::delete($path . $kelas->gambar .".jpg");
            File::delete($path . $kelas->gambar ."n.jpg");

            TpCU::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','TP CU Telah berhasil di hapus.');
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