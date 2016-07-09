<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\PerkembanganCU;
use App\Models\Cuprimer;

class AdminPerkembangancuController extends Controller{

    protected $kelaspath = 'perkembangancu';
    /**
     * Display a listing of artikels
     *
     * @return Response
     */
    public function index()
    {
        try{
        	$datas = PerkembanganCU::with('cuprimer')->orderBy('cu','asc')->get();
            $datas2 = Cuprimer::all();
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
            $validator = Validator::make($data = Input::all(), PerkembanganCU::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $date = Input::get('dataper');
	        if(!empty($date)){
	            $timestamp2 = strtotime(str_replace('/', '-',$date));
	            $tanggal2 = date('Y-m-d',$timestamp2);
	            array_set($data,'dataper',$tanggal2);
	        }

            PerkembanganCU::create($data);

            if(Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage','Data Perkembangan CU Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Data Perkembangan CU Telah berhasil ditambah.');
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
            $data = PerkembanganCU::find($id);
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
            $kelas = PerkembanganCU::findOrFail($id);

            $validator = Validator::make($data = Input::all(), PerkembanganCU::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

    		$date = Input::get('dataper');
	        if(!empty($date)){
	            $timestamp2 = strtotime(str_replace('/', '-',$date));
	            $tanggal2 = date('Y-m-d',$timestamp2);
	            array_set($data,'dataper',$tanggal2);
	        }
            $kelas->update($data);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Data Perkembangan CU Telah berhasil diubah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Data Perkembangan CU Telah berhasil diubah.');
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

            PerkembanganCU::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Data Perkembangan CU Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}