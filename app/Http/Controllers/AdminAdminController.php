<?php

namespace App\Http\Controllers;

use DB;

use App\Models\Cuprimer;
use App\Models\Admin;

class AdminAdminController extends controller{

    protected $kelaspath = 'admin';

    public function index()
    {
        try{
            $datas = Admin::all();

            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            $datas2 = Cuprimer::orderBy('name','asc')->get();

            return view('admins.'.$this->kelaspath.'.create',compact('datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Admin::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');
            $username = Input::get('username');

            $kelas = new Admin();

            $kelas->name = $name;
            $kelas->username = $username;
            $password = Input::get('password');
            $password2 = Input::get('password2');

            $checkusername = Admin::where('username','=',$username)->first();

            if(!empty($checkusername))
                return Redirect::back()->withInput()->with('errormessage','<b>Username</b> tidak tersedia, silahkan coba <b>Username</b> lain.');

            if($password != $password2)
                return Redirect::back()->withInput()->with('errormessage','<b>Password</b> dengan <b>Konfirmasi Password</b> tidak sama.');

            $kelas->password = Hash::make($password);
            $tipe = Input::get('tipe');
            if($tipe == "2"){
                $role = Role::where('id','=','9')->first();
                $kelas->cu = Input::get('cu');
                $kelas->save();

                $kelas2 = Admin::where('username','=',$username)->first();
                $kelas2->attachRole( $role );
                $kelas2->roles()->attach( $role->id );
            }else{
                $role = new Role();
                $role->name = $username;
                $role->save();

                $kelas->cu = "0";
                $kelas->save();

                $kelas2 = Admin::where('username','=',$username)->first();
                $kelas2->attachRole( $role );
                $kelas2->roles()->attach( $role->id );

                $adminrole = Role::where('name','=',$username)->first();
                $this->hak_akses($adminrole,$kelas2);
            }

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Admin <b><i>' .$name. '</i></b> telah berhasil ditambah.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $data = Admin::find($id);
            $datas2 = Cuprimer::orderBy('name','asc')->get();

            return view('admins.'.$this->kelaspath.'.edit', compact('data','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit_password($id)
    {
        try{
            $data = Admin::find($id);

            return view('admins.'.$this->kelaspath.'.edit_password', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit_akses($id)
    {
        try{
            $data = Admin::find($id);

            return view('admins.'.$this->kelaspath.'.edit_akses', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_password($id)
    {
        try{
            $kelas = Admin::findOrFail($id);

            $validator = Validator::make($data = Input::all(), Admin::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $username = Input::get('username');
            $kelas->username = $username;
            $password1 = Input::get('password');
            $password2 = Input::get('password2');

            if($password1 != $password2)
                return Redirect::back()->withInput()->with('errormessage', 'Password lama anda tidak sesuai.');

            $kelas->password = Hash::make(Input::get('password'));

            $kelas->update();
            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Admin <b><i>' . $username . '</i></b> telah berhasil diubah.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = Admin::where('id','=',$id)->first();
            $name = $kelas->name;
            $roles = Role::where('name','=',$kelas->username)->first();

            if(!is_null($roles)) {
                if ($kelas->cu > 0) {
                    $roles->detach();
                } else{
                    $roles->perms()->detach();
                    Role::destroy($roles->id);
                }
            }

            Admin::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Admin <b><i>' . $name . '</i></b> telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_status($id){
        try{
            $kelas = Admin::findOrFail($id);
            $name = $kelas->name;
            $status = $kelas->status;

            if($status == 1) {
                $statusname = "non-aktifkan";
                $kelas->status = 0;
            }else{
                $statusname = "diaktifkan";
                $kelas->status = 1;
            }

            $kelas->update();
            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Status admin <b><i>' . $name . '</i></b> telah <b>' . $statusname . '</b>.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_akses($id){
        try{
            $kelas = Admin::findOrFail($id);
            $name = $kelas->name;
            $adminrole = Role::where('name', '=', $kelas->username)->first();
            $this->hak_akses($adminrole, $kelas);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Hak akses <b><i>' . $name . '</i></b> telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function hak_akses($adminrole,$admin2){
        if(Input::get('admin') == 1) {
            if (!$admin2->can('admin')){
                $akses = Permission::where('name', '=', 'admin')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('admin')){
                $akses = Permission::where('name','=','admin')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('artikel') == 1){
            if (!$admin2->can('artikel')){
                $akses = Permission::where('name', '=', 'artikel')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('artikel')){
                $akses = Permission::where('name','=','artikel')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('cuprimer') == 1){
            if (!$admin2->can('cuprimer')){
                $akses = Permission::where('name', '=', 'cuprimer')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('cuprimer')){
                $akses = Permission::where('name','=','cuprimer')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('gambarkegiatan') == 1){
            if (!$admin2->can('gambarkegiatan')){
                $akses = Permission::where('name', '=', 'gambarkegiatan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('gambarkegiatan')){
                $akses = Permission::where('name','=','gambarkegiatan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('infogerakan') == 1){
            if (!$admin2->can('infogerakan')){
                $akses = Permission::where('name', '=', 'infogerakan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('infogerakan')){
                $akses = Permission::where('name','=','infogerakan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('kategoriartikel') == 1){
            if (!$admin2->can('kategoriartikel')){
                $akses = Permission::where('name', '=', 'kategoriartikel')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('kategoriartikel')){
                $akses = Permission::where('name','=','kategoriartikel')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('kegiatan') == 1){
            if (!$admin2->can('kegiatan')){
                $akses = Permission::where('name', '=', 'kegiatan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('kegiatan')){
                $akses = Permission::where('name','=','kegiatan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('pengumuman') == 1){
            if (!$admin2->can('pengumuman')){
                $akses = Permission::where('name', '=', 'pengumuman')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('pengumuman')){
                $akses = Permission::where('name','=','pengumuman')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('staff') == 1){
            if (!$admin2->can('staff')){
                $akses = Permission::where('name', '=', 'staff')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('staff')){
                $akses = Permission::where('name','=','staff')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('wilayahcuprimer') == 1){
            if (!$admin2->can('wilayahcuprimer')){
                $akses = Permission::where('name', '=', 'wilayahcuprimer')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('wilayahcuprimer')){
                $akses = Permission::where('name','=','wilayahcuprimer')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('download') == 1){
            if (!$admin2->can('download')){
                $akses = Permission::where('name', '=', 'download')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('download')){
                $akses = Permission::where('name','=','download')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('saran') == 1){
            if (!$admin2->can('saran')){
                $akses = Permission::where('name', '=', 'saran')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('saran')){
                $akses = Permission::where('name','=','saran')->first();
                $adminrole->detachPermission($akses);
            }
        }
    }

}