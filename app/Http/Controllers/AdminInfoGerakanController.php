<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\InfoGerakan;

class AdminInfoGerakanController extends Controller{

    protected $kelaspath = 'infogerakan';
    
    public function index_litbang()
    {
        return view('admins.'.$this->kelaspath.'.index_litbang');
    }

    public function edit($id)
    {
        try{
            $data = InfoGerakan::find($id);

            return view('admins.'.$this->kelaspath.'.edit', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update($id)
    {
        try{
            $validator = Validator::make($data = Input::all(), InfoGerakan::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $kelas = InfoGerakan::findOrFail($id);
            $timestamp = strtotime(Input::get('tanggal'));
            $tanggal = date('Y-m-d',$timestamp);

            $kelas->tanggal = $tanggal;
            $kelas->jumlah_anggota = Input::get('jumlah_anggota');
            $kelas->jumlah_cu = Input::get('jumlah_cu');
            $kelas->jumlah_staff_cu = Input::get('jumlah_staff_cu');
            $kelas->piutang_beredar = Input::get('piutang_beredar');
            $kelas->piutang_lalai_1 = Input::get('piutang_lalai_1');
            $kelas->piutang_lalai_2 = Input::get('piutang_lalai_2');
            $kelas->piutang_bersih = Input::get('piutang_bersih');
            $kelas->asset = Input::get('asset');
            $kelas->shu = Input::get('shu');

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.edit',array(1))->with('sucessmessage',
                                    'Informasi Gerakan Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}