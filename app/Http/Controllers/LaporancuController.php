<?php
namespace App\Http\Controllers;

use DB;
use Input;
use Excel;
use Redirect;
use Validator;
use App\Models\LaporanCu;
use App\Models\Cuprimer;
use App\Models\Excelitems;
use Jenssegers\Date\Date;

class LaporanCuController extends Controller{

    protected $kelaspath = 'laporancu';
    /**
     * Display a listing of artikels
     *
     * @return Response
     */
    public function index()
    {
        try{
            $data = LaporanCu::with('cuprimer')->orderBy('periode','DESC')->get();
            $data1 = $data->groupBy('no_ba');

            $datas = collect([]);
            foreach ($data1 as $data2){
                $datas->push($data2->first());
            }

            $dataarray = $datas->toArray();

            foreach ($datas as $data){
                if(!empty($data->cuprimer)){
                    $gperiode[] = str_limit($data->cuprimer->name,7);
                }
            }
            return view('admins.'.$this->kelaspath.'.index', compact('datas','dataarray','gperiode'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_periode($periode)
    {
        try{

            $data = LaporanCu::with('cuprimer')->where('periode','<=',$periode)->orderBy('periode','DESC')->get();
            $data1 = $data->groupBy('no_ba');

            $datas = collect([]);
            foreach ($data1 as $data2){
                $datas->push($data2->first());
            }

            $dataarray = $datas->toArray();

            foreach ($datas as $datacu){
                $gperiode[] = $datacu->cuprimer->name;
            }

            return view('admins.'.$this->kelaspath.'.index', compact('datas','dataarray','gperiode'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_bkcu()
    {
        try{
            $data = LaporanCu::orderBy('periode','ASC')->groupBy('periode')->get(['periode']);
            $periodeiode = $data->groupBy('periode');

            $periodeiode1 = collect([]);
            foreach ($periodeiode as $data){
                $periodeiode1->push($data->first());
            }

            $periodes = array_column($periodeiode1->toArray(),'periode');

            foreach ($periodes as $periode) {
                $datacu = LaporanCu::with('cuprimer')->where('periode','<=',$periode)->orderBy('periode','DESC')->get();
                $datacu1= $datacu->groupBy('no_ba');

                $datascu = collect([]);
                foreach ($datacu1 as $data2){
                    $datascu->push($data2->first());
                }

                $tot_l_biasa = 0;
                $tot_l_lbiasa = 0;
                $tot_p_biasa = 0;
                $tot_p_lbiasa = 0;
                $tot_anggota = 0;
                $tot_aset = 0;
                $tot_aktivalancar = 0;
                $tot_simpanansaham = 0;
                $tot_nonsaham_unggulan = 0;
                $tot_nonsaham_harian = 0;
                $tot_hutangspd = 0;
                $tot_piutangberedar = 0;
                $tot_piutanglalai_1bulan = 0;
                $tot_piutanglalai_12bulan = 0;
                $tot_piutangbersih = 0;
                $tot_beredar = 0;
                $tot_lalai = 0;
                $tot_dcr = 0;
                $tot_dcu = 0;
                $tot_totalpendapatan = 0;
                $tot_totalbiaya = 0;
                $tot_shu = 0;
                $tot_cu = 0;
                $tot_culaporan = 0;

                foreach($datascu as $data){
                    $tot_l_biasa += $data->l_biasa;
                    $tot_l_lbiasa += $data->l_lbiasa;
                    $tot_p_biasa += $data->p_biasa;
                    $tot_p_lbiasa += $data->p_lbiasa;
                    $totalanggota = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;
                    $tot_anggota += $totalanggota;
                    $tot_aset += $data->aset;
                    $tot_aktivalancar += $data->aktivalancar;
                    $tot_simpanansaham += $data->simpanansaham;
                    $tot_nonsaham_unggulan += $data->nonsaham_unggulan;
                    $tot_nonsaham_harian += $data->nonsaham_harian;
                    $tot_hutangspd += $data->hutangspd;
                    $tot_piutangberedar += $data->piutangberedar;
                    $tot_piutanglalai_1bulan += $data->piutanglalai_1bulan;
                    $tot_piutanglalai_12bulan += $data->piutanglalai_12bulan;
                    $piutangbersih = $data->piutangberedar - ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan);
                    $tot_piutangbersih += $piutangbersih;
                    $rasio_beredar = $data->aset != 0 ? (($data->piutangberedar / $data->aset)*100) : 0 ;
                    $tot_beredar += $rasio_beredar;
                    $rasio_lalai = $data->piutangberedar != 0 ? ((($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar)*100) : 0; 
                    $tot_lalai += $rasio_lalai;
                    $tot_dcr += $data->dcr;
                    $tot_dcu += $data->dcu;
                    $tot_totalpendapatan += $data->totalpendapatan;
                    $tot_totalbiaya += $data->totalbiaya;
                    $tot_shu += $data->shu;
                    $tot_cu++;
                    if($data->periode == $datascu->first()->periode){
                        $tot_culaporan++;
                    }
                } 
                $date = new Date($periode);
                $gperiode[] = $date->format('F Y');

                $infogerakans[$periode] = array(
                        'periode' => $date->format('F Y'),
                        'l_biasa' => $tot_l_biasa,
                        'l_lbiasa' => $tot_l_lbiasa,
                        'p_biasa' => $tot_p_biasa,
                        'p_lbiasa' => $tot_p_lbiasa,
                        'anggota' => $tot_anggota,
                        'aset' => $tot_aset,
                        'aktivalancar' => $tot_aktivalancar,
                        'simpanansaham' => $tot_simpanansaham,
                        'nonsaham_unggulan' => $tot_nonsaham_unggulan,
                        'nonsaham_harian' => $tot_nonsaham_harian,
                        'hutangspd' => $tot_hutangspd,
                        'piutangberedar' => $tot_piutangberedar,
                        'piutanglalai_1bulan' => $tot_piutanglalai_1bulan,
                        'piutanglalai_12bulan' => $tot_piutanglalai_12bulan,
                        'piutangbersih' => $tot_piutangbersih,
                        'beredar' => $tot_beredar,
                        'lalai' => $tot_lalai,
                        'dcr' => $tot_dcr,
                        'dcu' => $tot_dcu,
                        'totalpendapatan' => $tot_totalpendapatan,
                        'totalbiaya' => $tot_totalbiaya,
                        'shu' => $tot_shu,
                        'tot_cu' => $tot_cu,
                        'tot_culaporan' => $tot_culaporan
                );
            }
            $dataarray = $infogerakans;
            return view('admins.'.$this->kelaspath.'.index_bkcu', compact('infogerakans','dataarray','gperiode'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }    
    }

    public function index_cu($id)
    {
        try{
            $datas = LaporanCu::where('no_ba','=',$id)->orderBy('periode','desc')->get();

            $dataarray = $datas->sortBy('periode')->toArray();
            $periode = array_column($dataarray,'periode');

            foreach ($periode as $a){
                $gperiode[] = date('F Y', strtotime($a));
            }

//            dd($gperiode);

            return view('admins.'.$this->kelaspath.'.index', compact('datas','dataarray','gperiode','id'));
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
            $validator = Validator::make($data = Input::all(), LaporanCu::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $date = Input::get('periode');
	        if(!empty($date)){
	            $timestamp2 = strtotime(str_replace('/', '-',$date));
	            $tanggal2 = date('Y-m-d',$timestamp2);
	            array_set($data,'periode',$tanggal2);
	        }

            $cu = \Auth::user()->getCU();
            if($cu != '0'){
                $cuprimer = \App\Models\Cuprimer::where('id','=',$cu)->select('no_ba')->first();
                $no_ba = $cuprimer->no_ba;
                array_set($data,'no_ba',$no_ba);
            }

            LaporanCu::create($data);

            if(Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage','Data Perkembangan CU Telah berhasil ditambah.');
            }else{
                if($cu == '0'){
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Data Perkembangan CU Telah berhasil ditambah.');
                }else{
                    return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($no_ba))->with('sucessmessage', 'Data Perkembangan CU Telah berhasil diubah.');
                }
                
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
            $data = LaporanCu::find($id);
            $datas2 = Cuprimer::orderBy('name','asc')->get();

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
            $kelas = LaporanCu::findOrFail($id);

            $validator = Validator::make($data = Input::all(), LaporanCu::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            // dd($data);

    		$date = Input::get('periode');
	        if(!empty($date)){
	            $timestamp2 = strtotime(str_replace('/', '-',$date));
	            $tanggal2 = date('Y-m-d',$timestamp2);
	            array_set($data,'periode',$tanggal2);
	        }
            
            $cu = \Auth::user()->getCU();
            if($cu != '0'){
                $cuprimer = \App\Models\Cuprimer::where('id','=',$cu)->select('no_ba')->first();
                $no_ba = $cuprimer->no_ba;
                array_set($data,'no_ba',$no_ba);
            }

            $kelas->update($data);

            if (Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Data Perkembangan CU Telah berhasil diubah.');
            }else{
                if($cu == '0')
                    return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Data Perkembangan CU Telah berhasil diubah.');
                else
                    return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($no_ba))->with('sucessmessage', 'Data Perkembangan CU Telah berhasil diubah.');
            }
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

            LaporanCu::destroy($id);

            $cu = \Auth::user()->getCU();
            $cuprimer = \App\Models\Cuprimer::where('no_ba','=',$cu)->select('no_ba')->first();
            
              
            if($cu == '0'){
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Data Perkembangan CU Telah berhasil di hapus.');
            }else{
                $no_ba = $cuprimer->no_ba;
                return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($no_ba))->with('sucessmessage','Data Perkembangan CU Telah berhasil di hapus.');
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function importexcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::selectSheetsByIndex(0)->load($path, function($reader) {
            })->get();

            if(!empty($data) && $data->count()){
                foreach($data as $key => $value){
                    $insert[] = [
                        'no_ba' => $value->no_ba,
                        'l_biasa' => $value->l_biasa,
                        'l_lbiasa' => $value->l_lbiasa,
                        'p_biasa' => $value->p_biasa,
                        'p_lbiasa' => $value->p_lbiasa,
                        'totalanggota_lalu' => $value->totalanggota_lalu,
                        'aset' => $value->aset,
                        'aset_lalu' => $value->aset_lalu,
                        'aset_masalah' => $value->aset_masalah,
                        'aset_tidak_menghasilkan' => $value->aset_tidak_menghasilkan,
                        'aset_likuid_tidak_menghasilkan' => $value->aset_likuid_tidak_menghasilkan,
                        'aktivalancar' => $value->aktivalancar,
                        'simpanansaham' => $value->simpanansaham,
                        'simpanansaham_lalu' => $value->simpanansaham_lalu,
                        'nonsaham_unggulan' => $value->nonsaham_unggulan,
                        'nonsaham_harian' => $value->nonsaham_harian,
                        'hutangspd' => $value->hutangspd,
                        'hutang_tidak_berbiaya_30hari' => $value->hutang_tidak_berbiaya_30hari,
                        'totalhutang_pihak3' => $value->totalhutang_pihak3,
                        'piutangberedar' => $value->piutangberedar,
                        'piutanganggota' => $value->piutanganggota,
                        'piutanglalai_1bulan' => $value->piutanglalai_1bulan,
                        'piutanglalai_12bulan' => $value->piutanglalai_12bulan,
                        'dcr' => $value->dcr,
                        'dcu' => $value->dcu,
                        'iuran_gedung' => $value->iuran_gedung,
                        'donasi' => $value->donasi,
                        'bjs_saham' => $value->bjs_saham,
                        'beban_operasional' => $value->beban_operasional,
                        'investasi_likuid' => $value->investasi_likuid,
                        'totalpendapatan' => $value->totalpendapatan,
                        'totalbiaya' => $value->totalbiaya,
                        'shu' => $value->shu,
                        'shu_lalu' => $value->shu_lalu,
                        'lajuinflasi' => $value->lajuinflasi,
                        'hargapasar' => $value->hargapasar,
                        'periode' => $value->periode
                    ];
                }

                if(!empty($insert)){
                  DB::table('LaporanCu')->insert($insert);
                  return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Data Perkembangan CU Telah berhasil di import.');
                }

            // $perkembangans = LaporanCu::get(['cu','periode']);

            // if(!empty($data) && $data->count()){
            //     foreach ($data as $key => $value) {
            //         foreach ($perkembangans as $perkembangan){
            //             $date = new Date($value->periode);
            //             $periode = $date->format('Y-m-d');
            //             if($perkembangan->cu != (int)$value->no_ba && $perkembangan->periode != $periode){
            //                 $insert[] = [
            //                     'no_ba' => $value->no_ba,
            //                     'l_biasa' => $value->l_biasa,
            //                     'l_lbiasa' => $value->l_lbiasa,
            //                     'p_biasa' => $value->p_biasa,
            //                     'p_lbiasa' => $value->p_lbiasa,
            //                     'aset' => $value->aset,
            //                     'aktivalancar' => $value->aktivalancar,
            //                     'simpanansaham' => $value->simpanansaham,
            //                     'nonsaham_unggulan' => $value->nonsaham_unggulan,
            //                     'nonsaham_harian' => $value->nonsaham_harian,
            //                     'hutangspd' => $value->hutangspd,
            //                     'piutangberedar' => $value->piutangberedar,
            //                     'piutanglalai_1bulan' => $value->piutanglalai_1bulan,
            //                     'piutanglalai_12bulan' => $value->piutanglalai_12bulan,
            //                     'dcr' => $value->dcr,
            //                     'dcr' => $value->dcu,
            //                     'totalpendapatan' => $value->totalpendapatan,
            //                     'totalbiaya' => $value->totalbiaya,
            //                     'shu' => $value->shu,
            //                     'periode' => $value->periode,
            //                 ];
            //             }
            //         }
            //     }

           // $perkembangan = LaporanCu::get(['cu','l_biasa','l_lbiasa','p_biasa','p_lbiasa',
           //                     'aset','aktivalancar','simpanansaham','nonsaham_unggulan','nonsaham_harian',
           //                     'hutangspd','piutangberedar','piutanglalai_1bulan','piutanglalai_12bulan',
           //                     'danacadangan_dcr','danacadangan_dcu','totalpendapatan','totalbiaya','shu','periode']);
           // $perkembangans = $perkembangan->toArray();
           // $tmpArray = array();
           // foreach($insert as $data1) {

           //     $duplicate = false;
           //     foreach($perkembangans as $data2) {
           //         if($data1['cu'] = $data2['cu'] && $data1['periode'] == $data2['periode']) $duplicate = true;
           //     }

           //     if($duplicate === false) $tmpArray[] = $data1;
           // }
           // $newData = $tmpArray;

            }
        }
      return back();
    }

    public function laporan_loop(){
        
    }
}


