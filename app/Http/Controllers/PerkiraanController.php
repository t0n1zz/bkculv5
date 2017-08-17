<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Excel;
use Redirect;
use Validator;
use App\Cuprimer;
use App\TpCU;
use App\Perkiraan;
use App\PerkiraanAI;
use Jenssegers\Date\Date;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;

class PerkiraanController extends Controller{

    protected $kelaspath = 'perkiraan';

    public function index()
    {
        try{
            $culists = Perkiraan::with('cuprimer')->select('cu')->groupBy('cu')->get();

            return view('admins.'.$this->kelaspath.'.index',compact('culists'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function periode($kdcu)
    {
        try{
            $tplist = Perkiraan::where('cu',$kdcu)->select('periode')->groupBy('periode')->get();

            if(!empty($tplist))
                return \Response::json(array_keys($tplist));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function perkiraan()
    {
        try{
            $kdcu = Input::get('kdcu');
            $kdtp = Input::get('kdtp');
            $periode = Input::get('periode');

            $datas = Perkiraan::with('induk','cuprimer')->where('cu',$kdcu)->where('tp',$kdtp)->where('periode',$periode)->get();

            $datafirst = $datas->first();
            $kdcu = $datafirst->cu;
            $kdtp = $datafirst->tp;
            $nmtp = TpCU::where('no_tp',$kdtp)->select('name')->first();
            $nmcu = Cuprimer::where('no_ba',$kdcu)->select('name')->first();
            $nmcu = !empty($nmcu) ? $nmcu->name : '';
            $nmtp = !empty($nmtp) ? $nmtp->name : '';
            $periode = $datafirst->periode;
            $date = new Date($periode);
            $periode = $date->format('d/m/Y');

            // return view('admins.'.$this->kelaspath.'.index',compact('datas','kdcu','kdtp','nmtp','periode'));

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }



    public function load_tp(Request $request)
    {
        try{
            $datas = Perkiraan::where('cu',$request->idcu)->select('tp')->groupBy('tp')->get();

            if(!empty($datas)){
                return \Response::json($datas);
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function load_periode(Request $request)
    {
        try{
            $datas = Perkiraan::where('cu',$request->idcu)->where('tp',$request->idtp)->select('periode')->groupBy('periode')->get();

            if(!empty($datas)){
                return \Response::json($datas);
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function load_perkiraan(Request $request)
    {
        try{
            $datas = Perkiraan::with('induk','cuprimer')->where('cu',$request->idcu)->where('tp',$request->idtp)->where('periode',$request->periode)->get();
            
            foreach ($datas as $key => $value) {
                $datasperkiraan[$key] = array(
                        'id' => $value->id,
                        'kode_induk' => $value->kode_induk,
                        'awal' => $value->awal,
                        'akhir' => $value->akhir,
                        'total' => $value->awal + $value->akhir,
                        'kode' => $value->kode,
                        'name' => $value->name,
                        'induk' => !empty($value->induk->name_induk) ? '['.$value->induk->kode_induk.'] '.$value->induk->name_induk : '',
                        'kelompok' => $value->kelompok
                    );
            }

            if(!empty($datasperkiraan)){
                // return Datatables::of($datas)->make();
                return \Response::json($datasperkiraan);
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function save()
    {
        try{
            $id = Input::get('id_perkiraan');
            $kode = Input::get('kode');
            $kdcu = Input::get('kdcu');
            $kdtp = Input::get('kdtp');
            
            if(!empty($id))
                $kelas = Perkiraan::findOrFail($id);
            else
                $kelas = New Perkiraan;

            $kode_awal = $kelas->kode;
            $kelas->kode = $kode;
            $kelas->name = Input::get('name');
            $kelas->kode_induk = Input::get('kode_induk');
            $kelas->kelompok = Input::get('kelompok');

            $kelas->save();


            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Perkiraan telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function destroy()
    {

    }
}


