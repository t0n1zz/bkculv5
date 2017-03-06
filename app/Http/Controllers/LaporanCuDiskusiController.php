<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Excel;
use Redirect;
use Validator;
use App\Cuprimer;
use App\LaporanCu;
use App\LaporanCuDiskusi;
use Jenssegers\Date\Date;
use App\User;
use App\Notifications\notifikasi;
use Illuminate\Support\Facades\Notification;

class LaporanCuDiskusiController extends Controller{

    /**
     * Store a newly created artikel in storage.
     *
     * @return Response
     */
    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), LaporanCuDiskusi::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $id_user = Auth::user()->getId();
            $cu = \Auth::user()->getCU();

            $route = Input::Get('route');

            array_set($data,'id_user',$id_user);

            $notifikasi = LaporanCuDiskusi::create($data);
            $periodesave = LaporanCu::where('id',$notifikasi->id_laporan)->select('periode')->first();
            $date = new Date($periodesave->periode);
            $periode = $date->format('F Y');

            if($cu != '0'){
                $cuprimer = Cuprimer::where('no_ba','=',$cu)->select('name')->first();
                $this->notifikasi_store('0',$notifikasi->id_laporan,$cuprimer->name,$periode,'Menulis',$notifikasi->content);
            }else{
                $no_ba = Input::get('no_ba');
                $this->notifikasi_store($no_ba,$notifikasi->id_laporan,'BKCU',$periode,'Menulis',$notifikasi->content);    
            }

            return Redirect($route)->with('sucessmessage','Diskusi Laporan CU Telah berhasil ditambah.');

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
    public function update()
    {
        try{
            $validator = Validator::make($data = Input::all(), LaporanCuDiskusi::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $id = Input::get('id');
            $route = Input::Get('route');
            $kelas = LaporanCuDiskusi::findOrFail($id);

            $content = $kelas->content;

            //simpan
            $kelas->update($data);

            $periodesave = LaporanCu::where('id',$kelas->id_laporan)->select('periode')->first();
            $date = new Date($periodesave->periode);
            $periode = $date->format('F Y');

            $cu = \Auth::user()->getCU();
            if($cu != '0'){
                $cuprimer = Cuprimer::where('no_ba','=',$cu)->select('name')->first();
                $this->notifikasi_store('0',$kelas->id_laporan,$cuprimer->name,$periode,'Mengubah',$content);
            }else{
                $no_ba = Input::get('no_ba');
                $this->notifikasi_store($no_ba,$kelas->id_laporan,'BKCU',$periode,'Mengubah',$content);    
            }

            return Redirect($route)->with('sucessmessage', 'Diskusi laporan CU Telah berhasil diubah.');
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

            $cu = \Auth::user()->getCU();
            $route = Input::Get('route');

            $notifikasi = LaporanCuDiskusi::find($id);

            LaporanCuDiskusi::destroy($id);
            $periodesave = LaporanCu::where('id',$notifikasi->id_laporan)->select('periode')->first();
            $date = new Date($periodesave->periode);
            $periode = $date->format('F Y');
           
            if($cu != '0'){
                $cuprimer = Cuprimer::where('no_ba','=',$cu)->select('name')->first();
                $this->notifikasi_store('0',$notifikasi->id_laporan,$cuprimer->name,$periode,'Menghapus',$notifikasi->content);
            }else{
                $no_ba = Input::get('no_ba');
                $this->notifikasi_store($no_ba,$notifikasi->id_laporan,'BKCU',$periode,'Menghapus',$notifikasi->content);    
            }
            
            return Redirect($route)->with('sucessmessage','Diskusi Laporan CU Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function notifikasi_store($no_ba,$id,$cu_name,$periodesave,$tipe,$content)
    {
        $users = User::where('cu',$no_ba)->get();
        foreach ($users as $user) {
            if($user->can('view.laporancu_view')){
                Notification::send($user, new notifikasi($id, $cu_name,$tipe.' pesan pada laporan periode '.$periodesave,$content,$tipe.' diskusilaporan'));
            }
        }
    }
}


