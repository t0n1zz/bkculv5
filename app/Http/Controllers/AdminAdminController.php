<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Redirect;
use Validator;
use App\Models\Cuprimer;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;

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
            $roles = Role::with('perms')->find($id);

            if(!empty($roles)){
                foreach ($roles->perms as $role){
                    $data[] = $role->name;
                }

                return \Response::json($data);
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_password()
    {
        try{
            $id = Input::get('id');
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

    public function update_akses(){
        try{
            $id = Input::get('id');
            $kelas = Admin::findOrFail($id);
            $name = $kelas->name;
            $adminrole = Role::where('name', '=', $kelas->username)->first();
            $this->hak_akses('pengumuman','index',$adminrole, $kelas);
            $this->hak_akses('pengumuman','create',$adminrole, $kelas);
            $this->hak_akses('pengumuman','update',$adminrole, $kelas);
            $this->hak_akses('pengumuman','destroy',$adminrole, $kelas);
            $this->hak_akses('saran','index',$adminrole, $kelas);
            $this->hak_akses('saran','destroy',$adminrole, $kelas);
            $this->hak_akses('artikel','index',$adminrole, $kelas);
            $this->hak_akses('artikel','create',$adminrole, $kelas);
            $this->hak_akses('artikel','update',$adminrole, $kelas);
            $this->hak_akses('artikel','destroy',$adminrole, $kelas);
            $this->hak_akses('kategoriartikel','index',$adminrole, $kelas);
            $this->hak_akses('kategoriartikel','create',$adminrole, $kelas);
            $this->hak_akses('kategoriartikel','update',$adminrole, $kelas);
            $this->hak_akses('kategoriartikel','destroy',$adminrole, $kelas);
            $this->hak_akses('kegiatan','index',$adminrole, $kelas);
            $this->hak_akses('kegiatan','create',$adminrole, $kelas);
            $this->hak_akses('kegiatan','update',$adminrole, $kelas);
            $this->hak_akses('kegiatan','detail',$adminrole, $kelas);
            $this->hak_akses('kegiatan','destroy',$adminrole, $kelas);
            $this->hak_akses('cu','index',$adminrole, $kelas);
            $this->hak_akses('cu','create',$adminrole, $kelas);
            $this->hak_akses('cu','update',$adminrole, $kelas);
            $this->hak_akses('cu','detail',$adminrole, $kelas);
            $this->hak_akses('cu','destroy',$adminrole, $kelas);
            $this->hak_akses('wilayahcu','index',$adminrole, $kelas);
            $this->hak_akses('wilayahcu','create',$adminrole, $kelas);
            $this->hak_akses('wilayahcu','update',$adminrole, $kelas);
            $this->hak_akses('wilayahcu','destroy',$adminrole, $kelas);
            $this->hak_akses('tpcu','index',$adminrole, $kelas);
            $this->hak_akses('tpcu','create',$adminrole, $kelas);
            $this->hak_akses('tpcu','update',$adminrole, $kelas);
            $this->hak_akses('tpcu','destroy',$adminrole, $kelas);
            $this->hak_akses('perkembangancu','index',$adminrole, $kelas);
            $this->hak_akses('perkembangancu','create',$adminrole, $kelas);
            $this->hak_akses('perkembangancu','update',$adminrole, $kelas);
            $this->hak_akses('perkembangancu','detail',$adminrole, $kelas);
            $this->hak_akses('perkembangancu','destroy',$adminrole, $kelas);
            $this->hak_akses('staf','index',$adminrole, $kelas);
            $this->hak_akses('staf','create',$adminrole, $kelas);
            $this->hak_akses('staf','update',$adminrole, $kelas);
            $this->hak_akses('staf','detail',$adminrole, $kelas);
            $this->hak_akses('staf','destroy',$adminrole, $kelas);
            $this->hak_akses('download','index',$adminrole, $kelas);
            $this->hak_akses('download','create',$adminrole, $kelas);
            $this->hak_akses('download','update',$adminrole, $kelas);
            $this->hak_akses('download','destroy',$adminrole, $kelas);


            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Hak akses <b><i>' . $name . '</i></b> telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function hak_akses($namaakses,$tipe,$adminrole,$kelas){
        if(Input::get($namaakses.'_'.$tipe) == 1) {
            if (!$kelas->can($namaakses.'_'.$tipe)){
                $permission = Permission::where('name', '=', $namaakses.'_'.$tipe)->first();
                $adminrole->attachPermission($permission);
            }
        }else{
            if($kelas->can($namaakses.'_'.$tipe)){
                $permission = Permission::where('name','=',$namaakses.'_'.$tipe)->first();
                $adminrole->detachPermission($permission);
            }
        }
    }
}