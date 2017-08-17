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
use App\PerkiraanInduk;
use App\SimpananBKCU;
use App\SimpananBKCUTr;
use App\SIKOPDIT_PERKIRAAN;
use App\SIKOPDIT_SIMPANHR;
use App\SIKOPDIT_TRSHR;
use Jenssegers\Date\Date;

class MigrasiController extends Controller{

    protected $kelaspath = 'migrasi';

    public function index()
    {
        try{
           return view('admins.'.$this->kelaspath.'.index');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function perkiraan()
    {
        try{
            $connection = DB::connection('firebird');

            $cu = $connection->table('SETCU')->first();
            $kdcu = ltrim(substr($cu->KDCU,-3));
            $tpcu = $connection->table('SETTP')->join('TPCU','SETTP.KDTP','=','TPCU.KDTP')->select('TPCU.KDTP','TPCU.NMTP','TPCU.MANAGER')->first();
            $kdtpcu = ltrim(substr($tpcu->KDTP,-3));
            $periode = $connection->table('BULANSHM')->select('TGL')->orderBy('TGL','desc')->first();

            $dataperkiraantmp = Perkiraan::first();
            if($dataperkiraantmp->cu == $kdcu && $dataperkiraantmp->tp == $kdtpcu && $dataperkiraantmp->periode == $periode->TGL){
                $datas = Perkiraan::get();
            }else{
                $dataperkiraan = SIKOPDIT_PERKIRAAN::with('JURNALDTL')->where('TIPE','DETIL')->get();
                $juduls =  SIKOPDIT_PERKIRAAN::where('TIPE','JUDUL')->get();

                // Perkiraan::truncate();
                foreach($dataperkiraan as $data){
                    $indukNO = "";
                    $indukNM = "";

                    foreach($juduls as $judul){
                        if($judul->NOPRK == $data->INDUK){
                            $indukNO = $judul->NOPRK;
                            $indukNM = strtoupper($judul->NMPRK);
                        }
                    }

                    $perksa = $data->PERKSA->FIRST();
                    $sldawl = 0;
                    $sldawl = !empty($perksa) ? $perksa->SLDAWL : 0;
                    
                    $sldakr = 0;
                    foreach($data->JURNALDTL as $jurnal){
                        $sldakr = $sldakr + $jurnal->JUMLAH;
                    }
                    $this->store_perkiraan($data->NOPRK,$data->NMPRK,$indukNO,$indukNM,$data->KELOMPOK,$sldawl,$sldakr,$kdcu,$kdtpcu,$periode->TGL);
                }
                $datas = Perkiraan::get();
            }

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

            // return view('admins.'.$this->kelaspath.'.index',compact('datas','kdcu','nmcu','kdtp','nmtp','periode'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store_perkiraan($kode,$name,$kode_induk,$name_induk,$kelompok,$awal,$akhir,$cu,$tp,$periode)
    {
        try{
            $induk = PerkiraanInduk::where('kode_induk',$kode_induk)->first();
            if(empty($induk->id)){
                if(!empty($kode_induk)){
                    $kelas2 = new PerkiraanInduk;
                    $kelas2->kode_induk = $kode_induk;
                    $kelas2->name_induk = $name_induk;
                    $kelas2->save();
                    $id_induk = $kelas2->id;
                }else{
                    $id_induk = '';
                }
            }else{
                $id_induk = $induk->id;
            }
            
            $kelas = new Perkiraan;
            $kelas->kode = $kode;
            $kelas->kode_induk = $id_induk;
            $kelas->name = $name;
            $kelas->kelompok = $kelompok;
            $kelas->cu = $cu;
            $kelas->tp = $tp;
            $kelas->awal = $awal;
            $kelas->akhir = $akhir;
            $kelas->periode = $periode;
            $kelas->save();
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function simpanan_bkcu()
    {            
        $now = \Carbon\Carbon::now()->toDateTimeString();

        $simpananbkcu = SimpananBKCU::first(); 
        $simpananbkcutrs = SimpananBKCUTr::select('no_slip')->orderBy('no_slip','desc')->first();

        if(!empty($simpananbkcutrs))
            $noslip = $simpananbkcutrs->no_slip;
        
        if(empty($simpananbkcu)){
            $simpanans = SIKOPDIT_SIMPANHR::with('TRSHR')->get();
            foreach($simpanans as $simpanan){
                $sldakr = 0;
                foreach($simpanan->TRSHR as $trshr){
                    $sldakr = $sldakr + $trshr->JUMLAH;
                }
                $datasimpanan[] = array(
                    'no_rek' => $simpanan->NOREK,
                    'no_ba' => ltrim(substr($simpanan->NOA,-3),'0'),
                    'awal' => $simpanan->SLDAWL,
                    'akhir' => $sldakr,
                    'tipe' => $simpanan->KDSHR,
                    'buka' => $simpanan->TGLBUKA,
                    'tutup' => $simpanan->TGLTUTUP,
                    'created_at'=> $now,
                    'updated_at'=> $now
                ); 
            }
            if(!empty($datasimpanan))
                SimpananBKCU::insert($datasimpanan);
        }else{
            if(!empty($noslip)){
                $simpanans = SIKOPDIT_SIMPANHR::with(['TRSHR' => function($query) use($noslip){
                    $query->where('NOSLIP','>',$noslip);
                }])->get();
            }
            foreach($simpanans as $simpanan){
                $sldakr = 0;
                foreach($simpanan->TRSHR as $trshr){
                    $sldakr = $sldakr + $trshr->JUMLAH;
                }
                if($sldakr > 0){
                    $kelas = SimpananBKCU::where('no_rek',$simpanan->NOREK)->first();
                    $kelas->akhir = $kelas->akhir + $sldakr;
                    $kelas->tutup = $simpanan->TGLTUTUP;
                    $kelas->update();
                }
            }
        }

        if(!empty($noslip))
            $slips = SIKOPDIT_TRSHR::with('SLIPSHR.OPERATOR')->where('NOSLIP','>',$noslip)->get();
        else
            $slips = SIKOPDIT_TRSHR::with('SLIPSHR.OPERATOR')->get();

        foreach($slips as $slip){
            $tanggal = $slip->SLIPSHR->TGL. ' ' .$slip->SLIPSHR->JAM; 
            $dataslip[] = array(
                'no_rek' => $slip->NOREK,
                'no_slip' => $slip->NOSLIP,
                'snd' => $slip->SND,
                'jenis' => $slip->SLIPSHR->JNS,
                'jumlah' => $slip->JUMLAH,
                'penyetor' => $slip->SLIPSHR->NMPENYT,
                'keterangan' => $slip->SLIPSHR->KTR,
                'operator' => $slip->SLIPSHR->OPERATOR->NMOPR,
                'tanggal' => $tanggal,
                'created_at'=> $now,
                'updated_at'=> $now
            );  
        }
        if(!empty($dataslip))
            SimpananBKCUTr::insert($dataslip);
    }

    public function update_periode()
    {
        try{
            $periode = Input::get('modalubahperiode_periode');
            $date = strtotime(str_replace('/', '-',$periode));
            $periode = date('Y-m-d',$date);

            $datas = PerkiraanTMP::select('id')->get();

            foreach($datas as $data){
                DB::table('perkiraan_tmp')->where('id', $data->id)->update(['periode'=> $periode]);
            }

           
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}


