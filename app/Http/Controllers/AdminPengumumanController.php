<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\Pengumuman;


class AdminPengumumanController extends Controller{

    protected $indexpath = 'admins.pengumuman.index';

    /**
     * Display a listing of the resource.
     * GET /kategoriartikels
     *
     * @return Response
     */
    public function index()
    {
        try{
            $datas = Pengumuman::orderBy('urutan','asc')->get();;
            return view($this->indexpath, compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /kategoriartikels
     *
     * @return Response
     */
    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Pengumuman::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            Pengumuman::create($data);
            return Redirect::route($this->indexpath)->with('sucessmessage', 'Pengumuman <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     * PUT /kategoriartikels/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update()
    {
        try{
            $validator = Validator::make($data = Input::all(), Pengumuman::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $id = Input::get('id');
            $kelas = Pengumuman::findOrFail($id);

            //simpan
            $kelas->update($data);
            return Redirect::route($this->indexpath)->with('sucessmessage', 'Pengumuman  <b><i>' .$name. '</i></b> Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     * DELETE /kategoriartikels/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        try{
            $id = Input::get('id');

            Pengumuman::destroy($id);
            return Redirect::route($this->indexpath)->with('sucessmessage', 'Pengumuman telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_urutan()
    {
        try{
            $id = Input::get('id');
            $urutan = Input::get('urutan');
            $Pengumuman = Pengumuman::findOrFail($id);
            $cariurutan = Pengumuman::where('urutan','=',$urutan)->get()->first();

            if(!empty($cariurutan) && $Pengumuman->urutan != $urutan) {
                $Pengumuman->urutan = $urutan;
                $Pengumuman->update();

                $totals = Pengumuman::select(array('urutan'))->orderBy('urutan', 'asc')->get();
                $jumlah = $totals->count();
                $i = 0;
                $array = array();
                $array2 = array();
                foreach ($totals as $total) {
                    $i++;
                    $array[] = $i;
                    $array2[] = $total->urutan;
                }

                $result = array_diff($array, $array2);

                $value = array_first($result, function($value)
                { return $value; },$jumlah + 1);

                $ubahurutan = Pengumuman::find($cariurutan->id);
                $ubahurutan->urutan = $value;
                $ubahurutan->update();

                return Redirect::route($this->indexpath)->with('sucessmessage', 'Urutan pengumuman telah berhasil diubah.');
            }else{
                $Pengumuman->urutan = $urutan;

                $Pengumuman->update();
                return Redirect::route($this->indexpath)->with('sucessmessage', 'Urutan pengumuman telah berhasil diubah.');
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}