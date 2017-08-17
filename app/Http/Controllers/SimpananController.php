<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\SimpananBKCU;
use App\SimpananBKCUTr;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;

class SimpananController extends Controller{

    protected $kelaspath = 'simpanan';

    public function index_bkcu()
    {
        try{
            return view('admins.simpananbkcu.index');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function load_simpananbkcu(Request $request)
    {
        try{
            $datas = SimpananBKCU::with('cuprimer.wilayahcuprimer')->where('tipe',$request->jns)->get();
            
            foreach ($datas as $key => $value) {
                $tglbuka = new Date($value->buka);
                $tgltutup = new Date($value->tutup);
                $awal = -1 * $value->awal;
                $simpanans[$key] = array(
                        'id' => $value->id,
                        'no' => '',
                        'no_ba' => $value->no_ba,
                        'no_rek' => $value->no_rek,
                        'name' => $value->cuprimer->name,
                        'wilayah' => $value->cuprimer->wilayahcuprimer->name,
                        'awal' => $awal,
                        'akhir' => $value->akhir,
                        'total' => $awal + $value->akhir,
                        'buka' => $tglbuka->format('d F Y'),
                        'tutup' => $tgltutup->format('d F Y')
                    );
            }

            if(!empty($simpanans)){
                return \Response::json($simpanans);
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function load_simpananbkcutr(Request $request)
    {
        $datas = SimpananBKCUTr::where('no_rek',$request->no_rek)->get();

        foreach ($datas as $key => $value) {
            $tgl = new Date($value->tanggal);
            $simpanans[$key] = array(
                    'id' => $value->id,
                    'no_slip' => $value->no_slip,
                    'jenis' => $value->jenis,
                    'snd' => $value->snd,
                    'penyetor' => $value->penyetor,
                    'keterangan' => $value->keterangan,
                    'operator' => $value->operator,
                    'jumlah' => $value->jumlah,
                    'tanggal' => 'Transaksi '.$tgl->format('d F Y'). ' | ' .$tgl->format('H:i:s')
                );
        }

        if(!empty($simpanans)){
            return \Response::json($simpanans);
        } 
    }

    public function destroy()
    {

    }
}


