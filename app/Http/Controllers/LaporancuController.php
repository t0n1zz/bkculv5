<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Excel;
use Redirect;
use Validator;
use App\LaporanCu;
use App\LaporanCuDiskusi;
use App\LaporanCuHistory;
use App\Cuprimer;
use App\WilayahCuprimer;
use App\Excelitems;
use Jenssegers\Date\Date;
use App\User;
use App\Notifications\notifikasi;
use Illuminate\Support\Facades\Notification;

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
            $data = LaporanCu::with('cuprimer','diskusi')->orderBy('periode','DESC')->get();
            $data1 = $data->groupBy('no_ba');
 
            $datas = collect([]);
            foreach ($data1 as $data2){
                if(!empty($data2->first()->cuprimer))
                    $datas->push($data2->first());
            }

            $dataarray = $datas->toArray();

            $datasold = collect([]);
            foreach ($datas as $datacunew) {
                $dataold = LaporanCu::with('cuprimer')->where('no_ba',$datacunew->no_ba)->where('periode','<',$datacunew->periode)->orderBy('periode','DESC')->first();
                $datasold->push($dataold);
            }

            foreach ($datas as $data){
                if(!empty($data->cuprimer)){
                    $gperiode[] = str_limit($data->cuprimer->name,7);
                }
            }

            $wilayahcuprimers = WilayahCuprimer::get();
            $wilayahs = $this->laporancu_provinsi($wilayahcuprimers,$datas);
            $dos = $this->laporancu_do($datas);

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datasold','dataarray','gperiode','wilayahs','wilayahcuprimers','dos'));
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
                if(!empty($data2->first()->cuprimer))
                    $datas->push($data2->first());
            }

            $dataarray = $datas->toArray();

            $datasold = collect([]);
            foreach ($datas as $datacunew) {
                $dataold = LaporanCu::with('cuprimer')->where('no_ba',$datacunew->no_ba)->where('periode','<',$datacunew->periode)->orderBy('periode','DESC')->first();
                $datasold->push($dataold);
            }

            foreach ($datas as $datacu){
                $gperiode[] = $datacu->cuprimer->name;
            }

            $wilayahcuprimers = WilayahCuprimer::get();
            $wilayahs = $this->laporancu_provinsi($wilayahcuprimers,$datas);
            $dos = $this->laporancu_do($datas);

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datasold','dataarray','gperiode','wilayahs','wilayahcuprimers','dos'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_bkcu()
    {
        try{
            $data = LaporanCu::with('cuprimer')->orderBy('periode','ASC')->groupBy('periode')->get(['periode']);
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
                    if(!empty($data2->first()->cuprimer))
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

                $datas2[$periode] = array(
                        'periode' => $periode,
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
            $dataarray = $datas2;
            return view('admins.'.$this->kelaspath.'.index', compact('datas2','dataarray','gperiode'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }    
    }

    public function index_cu($id)
    {
        try{
            $cu = Auth::user()->getCU();

            if($cu > 0){
                if($cu != $id)
                    return Redirect::back();
            }

            $datas = LaporanCu::with('diskusi')->where('no_ba','=',$id)->orderBy('periode','asc')->get();
            $datashapus = LaporanCu::onlyTrashed()->where('no_ba','=',$id)->orderBy('periode','asc')->get();

            $dataarray = $datas->sortBy('periode')->toArray();
            $datas2 = $datas->toArray();
            $periode = array_column($dataarray,'periode');
            
            // dd($datas2);

            foreach ($periode as $a){
                $gperiode[] = date('F Y', strtotime($a));
            }

            return view('admins.'.$this->kelaspath.'.index', compact('datas','datashapus','datas2','dataarray','gperiode','id'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_hapus()
    {
        try{
            $datashapus = LaporanCu::onlyTrashed()->with('cuprimer')->orderBy('periode','asc')->get();

            return view('admins.'.$this->kelaspath.'.index', compact('datashapus'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function laporancu_provinsi($wilayahcuprimers,$datas)
    {
        foreach($wilayahcuprimers as $wilayahcuprimer){
            $wilayahs[$wilayahcuprimer->id] = array(
                    'id'=> $wilayahcuprimer->id,'nama'=> $wilayahcuprimer->name,'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                    'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                    'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                    'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0,'cu'=>0.0
            );
        }
        foreach($wilayahs as $wil){
            foreach($datas as $data){
                if(!empty($data->cuprimer)){
                    if($data->cuprimer->wilayah == $wil['id']){
                        $wilayahs[$data->cuprimer->wilayah]['l_biasa'] += $data->l_biasa;
                        $wilayahs[$data->cuprimer->wilayah]['l_lbiasa'] += $data->l_lbiasa;
                        $wilayahs[$data->cuprimer->wilayah]['p_biasa'] += $data->p_biasa;
                        $wilayahs[$data->cuprimer->wilayah]['p_lbiasa'] += $data->p_lbiasa;
                        $wilayahs[$data->cuprimer->wilayah]['aset'] += $data->aset;
                        $wilayahs[$data->cuprimer->wilayah]['aktivalancar'] += $data->aktivalancar;
                        $wilayahs[$data->cuprimer->wilayah]['simpanansaham'] += $data->simpanansaham;
                        $wilayahs[$data->cuprimer->wilayah]['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                        $wilayahs[$data->cuprimer->wilayah]['nonsaham_harian'] += $data->nonsaham_harian;
                        $wilayahs[$data->cuprimer->wilayah]['hutangspd'] += $data->hutangspd;
                        $wilayahs[$data->cuprimer->wilayah]['piutangberedar'] += $data->piutangberedar;
                        $wilayahs[$data->cuprimer->wilayah]['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                        $wilayahs[$data->cuprimer->wilayah]['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                        $wilayahs[$data->cuprimer->wilayah]['dcr'] += $data->dcr;
                        $wilayahs[$data->cuprimer->wilayah]['dcu'] += $data->dcu;
                        $wilayahs[$data->cuprimer->wilayah]['totalpendapatan'] += $data->totalpendapatan;
                        $wilayahs[$data->cuprimer->wilayah]['totalbiaya'] += $data->totalbiaya;
                        $wilayahs[$data->cuprimer->wilayah]['shu'] += $data->shu;
                        $wilayahs[$data->cuprimer->wilayah]['cu'] ++;
                    }
                }
            };
        }

        return $wilayahs;
    }

    public function laporancu_do($datas)
    {
        $dos = array(
            'do_barat'=>
                    array(
                            'nama' => 'BARAT',
                            'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                            'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                            'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                            'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0,'cu'=>0.0
                    ),
            'do_timur'=>
                    array(
                            'nama' => 'TIMUR',
                            'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                            'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                            'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                            'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0,'cu'=>0.0
                    ),
            'do_tengah'=>
                    array(
                            'nama' => 'TENGAH',
                            'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                            'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                            'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                            'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0,'cu'=>0.0
                    ),
        );
        foreach($datas as $data){
            if(!empty($data->cuprimer)){
                if($data->cuprimer->do == "1"){
                    $dos['do_barat']['l_biasa'] += $data->l_biasa;
                    $dos['do_barat']['l_lbiasa'] += $data->l_lbiasa;
                    $dos['do_barat']['p_biasa'] += $data->p_biasa;
                    $dos['do_barat']['p_lbiasa'] += $data->p_lbiasa;
                    $dos['do_barat']['aset'] += $data->aset;
                    $dos['do_barat']['aktivalancar'] += $data->aktivalancar;
                    $dos['do_barat']['simpanansaham'] += $data->simpanansaham;
                    $dos['do_barat']['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                    $dos['do_barat']['nonsaham_harian'] += $data->nonsaham_harian;
                    $dos['do_barat']['hutangspd'] += $data->hutangspd;
                    $dos['do_barat']['piutangberedar'] += $data->piutangberedar;
                    $dos['do_barat']['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                    $dos['do_barat']['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                    $dos['do_barat']['dcr'] += $data->dcr;
                    $dos['do_barat']['dcu'] += $data->dcu;
                    $dos['do_barat']['totalpendapatan'] += $data->totalpendapatan;
                    $dos['do_barat']['totalbiaya'] += $data->totalbiaya;
                    $dos['do_barat']['shu'] += $data->shu;
                    $dos['do_barat']['cu'] ++;
                }else if($data->cuprimer->do == "2"){
                    $dos['do_tengah']['l_biasa'] += $data->l_biasa;
                    $dos['do_tengah']['l_lbiasa'] += $data->l_lbiasa;
                    $dos['do_tengah']['p_biasa'] += $data->p_biasa;
                    $dos['do_tengah']['p_lbiasa'] += $data->p_lbiasa;
                    $dos['do_tengah']['aset'] += $data->aset;
                    $dos['do_tengah']['aktivalancar'] += $data->aktivalancar;
                    $dos['do_tengah']['simpanansaham'] += $data->simpanansaham;
                    $dos['do_tengah']['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                    $dos['do_tengah']['nonsaham_harian'] += $data->nonsaham_harian;
                    $dos['do_tengah']['hutangspd'] += $data->hutangspd;
                    $dos['do_tengah']['piutangberedar'] += $data->piutangberedar;
                    $dos['do_tengah']['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                    $dos['do_tengah']['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                    $dos['do_tengah']['dcr'] += $data->dcr;
                    $dos['do_tengah']['dcu'] += $data->dcu;
                    $dos['do_tengah']['totalpendapatan'] += $data->totalpendapatan;
                    $dos['do_tengah']['totalbiaya'] += $data->totalbiaya;
                    $dos['do_tengah']['shu'] += $data->shu;
                    $dos['do_tengah']['cu'] ++;
                }else if($data->cuprimer->do == "3"){
                    $dos['do_timur']['l_biasa'] += $data->l_biasa;
                    $dos['do_timur']['l_lbiasa'] += $data->l_lbiasa;
                    $dos['do_timur']['p_biasa'] += $data->p_biasa;
                    $dos['do_timur']['p_lbiasa'] += $data->p_lbiasa;
                    $dos['do_timur']['aset'] += $data->aset;
                    $dos['do_timur']['aktivalancar'] += $data->aktivalancar;
                    $dos['do_timur']['simpanansaham'] += $data->simpanansaham;
                    $dos['do_timur']['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                    $dos['do_timur']['nonsaham_harian'] += $data->nonsaham_harian;
                    $dos['do_timur']['hutangspd'] += $data->hutangspd;
                    $dos['do_timur']['piutangberedar'] += $data->piutangberedar;
                    $dos['do_timur']['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                    $dos['do_timur']['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                    $dos['do_timur']['dcr'] += $data->dcr;
                    $dos['do_timur']['dcu'] += $data->dcu;
                    $dos['do_timur']['totalpendapatan'] += $data->totalpendapatan;
                    $dos['do_timur']['totalbiaya'] += $data->totalbiaya;
                    $dos['do_timur']['shu'] += $data->shu;
                    $dos['do_timur']['cu'] ++;
                }
            }    
        };

        return $dos;    
    }

    public function detail($id)
    {
        try{
            $data = LaporanCu::withTrashed()->find($id);
            $no_ba = $data->no_ba;
            $periode = $data->periode;
            $cu = Auth::user()->getCU();

            if($cu > 0){
                if($cu != $no_ba)
                    return Redirect::back();
            }

            $datas2 = LaporanCuDiskusi::with('User')->where('id_laporan','=',$id)->get();
            $datahistories = $data->revisionHistory;

            return view('admins.'.$this->kelaspath.'.detail', compact('data','no_ba','periode','datas2','datahistories'));
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
            $culists = Cuprimer::orderBy('name','asc')->get();
            $culists_non = Cuprimer::onlyTrashed()->orderBy('name','asc')->get();

            return view('admins.'.$this->kelaspath.'.create', compact('culists','culists_non'));
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
                $periodesave = date('F Y',$timestamp2);
	            array_set($data,'periode',$tanggal2);
	        }

            $cu = \Auth::user()->getCU();

            if($cu != '0'){
                $cuprimer = Cuprimer::withTrashed()->where('no_ba','=',$cu)->select('name')->first();
                array_set($data,'no_ba',$cu);
                $notifikasi = LaporanCu::create($this->input_data($data));
                $this->notifikasi_store('0',$notifikasi->id,$cuprimer->name,$periodesave,'Menambah');
            }else{
                $notifikasi = LaporanCu::create($this->input_data($data));
                $no_ba = Input::get('no_ba');
                $this->notifikasi_store($no_ba,$notifikasi->id,'BKCU',$periodesave,'Menambah');    
            }

            if(Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage','Laporan CU Telah berhasil ditambah.');
            }else{
                if($cu == '0'){
                    return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($no_ba))->with('sucessmessage','Laporan CU Telah berhasil ditambah.');
                }else{
                    return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($cu))->with('sucessmessage', 'Laporan CU Telah berhasil diubah.');
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

            $cu = Auth::user()->getCU();
            if($cu > 0){
                if($cu != $data->no_ba)
                    return Redirect::back();
            }

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

    		$date = Input::get('periode');

	        if(!empty($date)){
	            $timestamp2 = strtotime(str_replace('/', '-',$date));
	            $tanggal2 = date('Y-m-d',$timestamp2);
                $periodesave = date('F Y',$timestamp2);
	            array_set($data,'periode',$tanggal2);
	        }
            
            $cu = \Auth::user()->getCU();
            if($cu != '0'){
                $cuprimer = Cuprimer::withTrashed()->where('no_ba','=',$cu)->select('name')->first();
                array_set($data,'no_ba',$cu);
                $this->notifikasi_store('0',$id,$cuprimer->name,$periodesave,'Mengubah');
            }else{
                $no_ba = $kelas->no_ba;
                $this->notifikasi_store($no_ba,$id,'BKCU',$periodesave,'Mengubah'); 
            }

            $kelas->update($this->input_data($data));

            if (Input::Get('simpan2')){
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Laporan CU Telah berhasil diubah.');
            }else{
                if($cu == '0')
                    return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($no_ba))->with('sucessmessage', 'Laporan CU Telah berhasil diubah.');
                else
                    return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($cu))->with('sucessmessage', 'Laporan CU Telah berhasil diubah.');
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_pearls()
    {
        try{
            $id = Input::get('id_ubah');
            $kelas = LaporanCu::findOrFail($id);

            $validator = Validator::make($data = Input::all(), LaporanCu::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $date = $kelas->periode;

            if(!empty($date)){
                $timestamp2 = strtotime(str_replace('/', '-',$date));
                $tanggal2 = date('Y-m-d',$timestamp2);
                $periodesave = date('F Y',$timestamp2);
            }
            
            $cu = \Auth::user()->getCU();
            if($cu != '0'){
                $cuprimer = Cuprimer::withTrashed()->where('no_ba','=',$cu)->select('name')->first();
                $this->notifikasi_store('0',$id,$cuprimer->name,$periodesave,'Mengubah');
            }else{
                $no_ba = $kelas->no_ba;
                $this->notifikasi_store($no_ba,$id,'BKCU',$periodesave,'Mengubah'); 
            }

            $kelas->update($data);
            if($cu == '0')
                return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($no_ba))->with('sucessmessage', 'Laporan CU Telah berhasil diubah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($cu))->with('sucessmessage', 'Laporan CU Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function input_data($data)
    {
        if(empty($data['l_biasa'])) $data['l_biasa'] = 0;
        if(empty($data['l_lbiasa'])) $data['l_lbiasa'] = 0;
        if(empty($data['p_biasa'])) $data['p_biasa'] = 0;
        if(empty($data['p_lbiasa'])) $data['p_lbiasa'] = 0;
        if(empty($data['totalanggota_lalu'])) $data['totalanggota_lalu'] = 0;
        if(empty($data['aset'])) $data['aset'] = 0;
        if(empty($data['aset_lalu'])) $data['aset_lalu'] = 0;
        if(empty($data['aset_masalah'])) $data['aset_masalah'] = 0;
        if(empty($data['aset_tidak_menghasilkan'])) $data['aset_tidak_menghasilkan'] = 0;
        if(empty($data['aset_likuid_tidak_menghasilkan'])) $data['aset_likuid_tidak_menghasilkan'] = 0;
        if(empty($data['aktivalancar'])) $data['aktivalancar'] = 0;
        if(empty($data['simpanansaham'])) $data['simpanansaham'] = 0;
        if(empty($data['nonsaham_unggulan'])) $data['nonsaham_unggulan'] = 0;
        if(empty($data['nonsaham_harian'])) $data['nonsaham_harian'] = 0;
        if(empty($data['simpanansaham_lalu'])) $data['simpanansaham_lalu'] = 0;
        if(empty($data['simpanansaham_des'])) $data['simpanansaham_des'] = 0;
        if(empty($data['hutangspd'])) $data['hutangspd'] = 0;
        if(empty($data['hutang_tidak_berbiaya_30hari'])) $data['hutang_tidak_berbiaya_30hari'] = 0;
        if(empty($data['totalhutang_pihak3'])) $data['totalhutang_pihak3'] = 0;
        if(empty($data['piutangberedar'])) $data['piutangberedar'] = 0;
        if(empty($data['piutanganggota'])) $data['piutanganggota'] = 0;
        if(empty($data['piutanglalai_1bulan'])) $data['piutanglalai_1bulan'] = 0;
        if(empty($data['piutanglalai_12bulan'])) $data['piutanglalai_12bulan'] = 0;
        if(empty($data['dcu'])) $data['dcu'] = 0;
        if(empty($data['dcr'])) $data['dcr'] = 0;
        if(empty($data['iuran_gedung'])) $data['iuran_gedung'] = 0;
        if(empty($data['donasi'])) $data['donasi'] = 0;
        if(empty($data['bjs_saham'])) $data['bjs_saham'] = 0;
        if(empty($data['beban_penyisihandcr'])) $data['beban_penyisihandcr'] = 0;
        if(empty($data['investasi_likuid'])) $data['investasi_likuid'] = 0;
        if(empty($data['totalpendapatan'])) $data['totalpendapatan'] = 0;
        if(empty($data['totalbiaya'])) $data['totalbiaya'] = 0;
        if(empty($data['shu'])) $data['shu'] = 0;
        if(empty($data['shu_lalu'])) $data['shu_lalu'] = 0;
        if(empty($data['lajuinflasi'])) $data['lajuinflasi'] = 0;
        if(empty($data['hargapasar'])) $data['hargapasar'] = 0;

        return $data;
    }

    public function restore()
    {
        try{
            $id = Input::get('id');
            $kelas = LaporanCu::onlyTrashed()->findOrFail($id);
            $name = $kelas->name;
            $no_ba = $kelas->no_ba;

            $kelas->restore();

            return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($no_ba))->with('sucessmessage', 'Laporan CU <b><i>' . $name . '</b></i>berhasil di pulihkan.');

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

            $periodesave = LaporanCu::find($id)->select('periode')->first();

            LaporanCu::destroy($id);

            $cu = \Auth::user()->getCU();

            if($cu != '0'){
                $cuprimer = Cuprimer::where('no_ba','=',$cu)->select('name')->first();
                $this->notifikasi_store('0',$id,$cuprimer->name,$periodesave,'Menghapus');
            }else{
                $no_ba = Input::get('no_ba');
                $this->notifikasi_store($no_ba,$id,'BKCU',$periodesave,'Menghapus'); 
            }
            
            if($cu == '0'){
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Laporan CU Telah berhasil di hapus.');
            }else{
                return Redirect::route('admins.'.$this->kelaspath.'.index_cu',array($cu))->with('sucessmessage','Laporan CU Telah berhasil di hapus.');
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function notifikasi_store($no_ba,$id,$cu_name,$periodesave,$tipe)
    {
        $users = User::where('cu',$no_ba)->get();
        foreach ($users as $user) {
            if($user->can('view.laporancu_view')){
                Notification::send($user, new notifikasi($id, $cu_name,$tipe.' laporan periode '.$periodesave,'',$tipe.' laporancu'));
            }
        }
    }

    public function importexcel()
    {
        $cu = \Auth::user()->getCU();
        if($cu == '0'){
            $tipe = Input::get('radiobtn');

            if($tipe == "multi"){
                if(Input::hasFile('import_multi')){
                    $path = Input::file('import_multi')->getRealPath();
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
                                'aset' => $value->aset,
                                'aktivalancar' => $value->aktivalancar,
                                'simpanansaham' => $value->simpanansaham,
                                'nonsaham_unggulan' => $value->nonsaham_unggulan,
                                'nonsaham_harian' => $value->nonsaham_harian,
                                'hutangspd' => $value->hutangspd,
                                'piutangberedar' => $value->piutangberedar,
                                'piutanglalai_1bulan' => $value->piutanglalai_1bulan,
                                'piutanglalai_12bulan' => $value->piutanglalai_12bulan,
                                'dcr' => $value->dcr,
                                'dcu' => $value->dcu,
                                'totalpendapatan' => $value->totalpendapatan,
                                'totalbiaya' => $value->totalbiaya,
                                'shu' => $value->shu,
                                'totalanggota_lalu' => $value->totalanggota_lalu,
                                'aset_lalu' => $value->aset_lalu,
                                'aset_masalah' => $value->aset_masalah,
                                'aset_tidak_menghasilkan' => $value->aset_tidak_menghasilkan,
                                'aset_likuid_tidak_menghasilkan' => $value->aset_likuid_tidak_menghasilkan,                 
                                'simpanansaham_lalu' => $value->simpanansaham_lalu,               
                                'hutang_tidak_berbiaya_30hari' => $value->hutang_tidak_berbiaya_30hari,
                                'totalhutang_pihak3' => $value->totalhutang_pihak3,        
                                'piutanganggota' => $value->piutanganggota,         
                                'iuran_gedung' => $value->iuran_gedung,
                                'donasi' => $value->donasi,
                                'bjs_saham' => $value->bjs_saham,
                                'beban_penyisihandcr' => $value->beban_penyisihandcr,
                                'investasi_likuid' => $value->investasi_likuid,
                                'shu_lalu' => $value->shu_lalu,
                                'lajuinflasi' => $value->lajuinflasi,
                                'hargapasar' => $value->hargapasar,
                                'periode' => $value->periode,
                                'created_at' => $value->tgl_masuk
                            ];
                        }

                        if(!empty($insert)){
                          DB::table('laporancu')->insert($insert);
                          return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Laporan CU Telah berhasil di import.');
                        }
                    }
                }
            }elseif($tipe == "single"){
                $nama_cu = Input::get('nama_cu');
                $date = Input::get('periode');
                if(!empty($date)){
                    $timestamp2 = strtotime(str_replace('/', '-',$date));
                    $tanggal2 = date('Y-m-d',$timestamp2);
                    array_set($data,'periode',$tanggal2);
                }

                if(Input::hasFile('import_single')){
                    $path = Input::file('import_file')->getRealPath();
                    $data = Excel::load($path, function($reader) {
                    })->get();

                    if(!empty($data)){
                        foreach ($data as $key => $value) {
                            if ($value->title == 'Dana Cadangan Resiko'){
                                $title = $value->title;
                                $description = $value->description;
                                $insert[] = [
                                        'title' => $title, 
                                        'description' => $description
                                ];
                            }                   
                        }
                    }

                    if(!empty($insert)){
                      DB::table('laporancu')->insert($insert);
                      return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Laporan CU Telah berhasil di import.');
                    }
                }
            }
        }else{

        }
        
      return back();
    }
}


