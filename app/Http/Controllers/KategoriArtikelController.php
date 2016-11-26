<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\Artikel;
use App\Models\KategoriArtikel;

class KategoriArtikelController extends Controller{

    protected $indexpath = 'admins.kategoriartikel.index';

    /**
     * Display a listing of the resource.
     * GET /kategoriartikels
     *
     * @return Response
     */
    public function index()
    {
        try{
            $datas = KategoriArtikel::orderBy('name','asc')->get();;
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
            $validator = Validator::make($data = Input::all(), KategoriArtikel::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            KategoriArtikel::create($data);

            return Redirect::route($this->indexpath)->with('sucessmessage', 'Kategori Artikel <b><i>' .$name.
                                                                         '</i></b> Telah berhasil ditambah.');
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
            $validator = Validator::make($data = Input::all(), KategoriArtikel::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $id = Input::get('id');
            $kelas = KategoriArtikel::findOrFail($id);

            $kelas->update($data);

            return Redirect::route($this->indexpath)->with('sucessmessage', 'Kategori artikel  <b><i>' .$name.
                                                                            '</i></b> Telah berhasil diubah.');
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
            $kelas = KategoriArtikel::find($id);

            if($kelas->hasartikel->count() > 0)
                return Redirect::back()->withInput()->with('errormessage','Masih terdapat artikel pada kategori ini,
                                                            silahkan dihapus terlebih dahulu.');

            KategoriArtikel::destroy($id);

            return Redirect::route($this->indexpath)->with('sucessmessage', 'Kategori artikel telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }
}