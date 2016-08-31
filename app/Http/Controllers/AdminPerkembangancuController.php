<?php
namespace App\Http\Controllers;

use DB;
use Input;
use Excel;
use Redirect;
use Validator;
use App\Models\PerkembanganCU;
use App\Models\Cuprimer;
use App\Models\Excelitems;
use Jenssegers\Date\Date;

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
//        	$datas = PerkembanganCU::with('cuprimer')
//                ->select(DB::raw('*,max(dataper) as dataper'))
//                ->orderby('dataper','desc')
//                ->get();

            $data = PerkembanganCU::with('cuprimer')->orderBy('dataper','DESC')->get();
            $data1 = $data->groupBy('cu');

            $datas = collect([]);
            foreach ($data1 as $data2){
                $datas->push($data2->first());
            }

            $dataarray = $datas->toArray();

            foreach ($datas as $datacu){
                $gdataper[] = $datacu->cuprimer->name;
            }

            return view('admins.'.$this->kelaspath.'.index', compact('datas','dataarray','gdataper'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_periode($periode)
    {
        try{

            $data = PerkembanganCU::with('cuprimer')->where('dataper','<=',$periode)->orderBy('dataper','DESC')->get();
            $data1 = $data->groupBy('cu');

            $datas = collect([]);
            foreach ($data1 as $data2){
                $datas->push($data2->first());
            }

            $dataarray = $datas->toArray();

            foreach ($datas as $datacu){
                $gdataper[] = $datacu->cuprimer->name;
            }

            return view('admins.'.$this->kelaspath.'.index', compact('datas','dataarray','gdataper'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_cu($id){
        try{
            $datas = PerkembanganCU::with('cuprimer')
                ->where('cu','=',$id)->orderBy('dataper','desc')->get();

            $dataarray = $datas->sortBy('dataper')->toArray();
            $dataper = array_column($dataarray,'dataper');

            foreach ($dataper as $a){
                $gdataper[] = date('F Y', strtotime($a));
            }

//            dd($gdataper);

            return view('admins.'.$this->kelaspath.'.index', compact('datas','dataarray','gdataper'));
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

    public function importexcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::selectSheetsByIndex(0)->load($path, function($reader) {
            })->get();

            $perkembangans = PerkembanganCU::get(['cu','dataper']);

            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    foreach ($perkembangans as $perkembangan){
                        $date = new Date($value->dataper);
                        $dataper = $date->format('Y-m-d');
                        if($perkembangan->cu != (int)$value->no_ba && $perkembangan->dataper != $dataper){
                            $insert[] = [
                                'cu' => $value->no_ba,
                                'l_biasa' => $value->l_biasa,
                                'l_lbiasa' => $value->l_lbiasa,
                                'p_biasa' => $value->p_biasa,
                                'p_lbiasa' => $value->p_lbiasa,
                                'kekayaan' => $value->kekayaan,
                                'aktivalancar' => $value->aktivalancar,
                                'simpanansaham' => $value->simpanansaham,
                                'nonsaham_unggulan' => $value->nonsaham_unggulan,
                                'nonsaham_harian' => $value->nonsaham_harian,
                                'hutangspd' => $value->hutangspd,
                                'piutangberedar' => $value->piutangberedar,
                                'piutanglalai_1bulan' => $value->piutanglalai_1bulan,
                                'piutanglalai_12bulan' => $value->piutanglalai_12bulan,
                                'dcr' => $value->dcr,
                                'dcr' => $value->dcu,
                                'totalpendapatan' => $value->totalpendapatan,
                                'totalbiaya' => $value->totalbiaya,
                                'shu' => $value->shu,
                                'dataper' => $value->dataper,
                            ];
                        }
                    }
                }

dd($insert);
//                $perkembangan = PerkembanganCU::get(['cu','l_biasa','l_lbiasa','p_biasa','p_lbiasa',
//                                    'kekayaan','aktivalancar','simpanansaham','nonsaham_unggulan','nonsaham_harian',
//                                    'hutangspd','piutangberedar','piutanglalai_1bulan','piutanglalai_12bulan',
//                                    'danacadangan_dcr','danacadangan_dcu','totalpendapatan','totalbiaya','shu','dataper']);
//                $perkembangans = $perkembangan->toArray();
//                $tmpArray = array();
//                foreach($insert as $data1) {
//
//                    $duplicate = false;
//                    foreach($perkembangans as $data2) {
//                        if($data1['cu'] = $data2['cu'] && $data1['dataper'] == $data2['dataper']) $duplicate = true;
//                    }
//
//                    if($duplicate === false) $tmpArray[] = $data1;
//                }
//                $newData = $tmpArray;

//                dd($insert);

//               if(!empty($insert)){
//                   DB::table('perkembangancu')->insert($insert);
//                   return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Data Perkembangan CU Telah berhasil di import.');
//               }
            }
        }
      return back();
    }
}