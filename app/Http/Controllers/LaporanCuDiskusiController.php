<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Excel;
use Redirect;
use Validator;
use App\Models\LaporanCuDiskusi;
use Jenssegers\Date\Date;

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
            $route = Input::Get('route');

            array_set($data,'id_user',$id_user);

            LaporanCuDiskusi::create($data);

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

            //simpan
            $kelas->update($data);
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

            LaporanCuDiskusi::destroy($id);

            $cu = \Auth::user()->getCU();
            $route = Input::Get('route');
            $cuprimer = \App\Models\Cuprimer::where('no_ba','=',$cu)->select('no_ba')->first();
            
            return Redirect($route)->with('sucessmessage','Diskusi Laporan CU Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}


