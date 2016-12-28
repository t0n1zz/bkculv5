<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Input;
use Redirect;
use Validator;
use App\Models\Cuprimer;
use App\Models\User;
use App\Http\Controllers\Controller;

use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;

class UserController extends controller{

    protected $kelaspath = 'admin';

    public function index()
    {
        try{
            $datas = User::where('id', '!=','0')->get();

            // dd($datas);

            return view('admins.'.$this->kelaspath.'.index', compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function detail($id)
    {
        try{
            $cu = Auth::user()->getCU();
            $iduser = Auth::user()->getId();

            if($cu > 0){
                if($iduser != $id)
                    return Redirect::back();
            }

            $data = User::find($id);
            $dataperms = $data->getPermissions();

            return view('admins.'.$this->kelaspath.'.detail', compact('data','dataperms','cu'));
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
            $validator = Validator::make($data = Input::all(), User::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $username = Input::get('username');

            $kelas = new User();

            $kelas->username = $username;
            $kelas->name = Input::get('name');
            $cu = Input::get('cu');
            $tipe = Input::get('tipe');
            $password = Input::get('password');
            $password2 = Input::get('password2');

            $checkusername = User::where('username','=',$username)->first();

            if(!empty($checkusername))
                return Redirect::back()->withInput()->with('errormessage','<b>Username</b> tidak tersedia, silahkan coba <b>Username</b> lain.');

            if($password != $password2)
                return Redirect::back()->withInput()->with('errormessage','<b>Password</b> dengan <b>Konfirmasi Password</b> tidak sama.');

            $kelas->password = Hash::make($password);
            $kelas->status = 1;
            if($tipe == "bkcu"){
                $kelas->cu = 'bkcu';
            }else{
                $kelas->cu = $cu;
            }
            $kelas->save();

            $role = new Role();
            $role->name = $username;
            $role->slug = $username;
            $role->save();

            $user = User::where('username','=',$username)->first();
            $user->assignRole( $role );

            $adminrole = Role::where('name','=',$username)->first();
            $this->hak_akses_save($adminrole);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Admin <b><i>' .$username. '</i></b> telah berhasil ditambah.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit_password($id)
    {
        try{
            $data = User::find($id);

            return view('admins.'.$this->kelaspath.'.edit_password', compact('data'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit_akses($id)
    {
        try{
            $admin = User::findOrFail($id);
            $role = Role::where('name', '=', $admin->username)->first();
            $roles = $role->getPermissions();

            if(!empty($roles)){

                return \Response::json(array_keys($roles));
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_password()
    {
        try{
            $cu = Auth::user()->getCU(); 

            if($cu == '0')
                $id = Input::get('id');
            else
                $id = Auth::user()->getId();
                 
            $kelas = User::findOrFail($id);

            
            $password1 = Input::get('password');
            $password2 = Input::get('password2');

            if($cu != 0){
                $password_now = Input::get('password_now');
                if (!Hash::check($password_now, $kelas->password))
                    return Redirect::back()->withInput()->with('errormessage', 'Password yang saat ini digunakan salah.');
            }

            if($password1 != $password2)
                return Redirect::back()->withInput()->with('errormessage', 'Password anda tidak sesuai.');

            $kelas->password = Hash::make(Input::get('password'));

            $kelas->update();

            if($cu == '0')
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Admin <b><i>' . $kelas->username . '</i></b> telah berhasil diubah.');
            else
                return Redirect::back()->with('sucessmessage', 'Password Admin <b><i>' . $kelas->username . '</i></b> telah berhasil diubah.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_status(){
        try{
            $id = Input::get('id');
            $kelas = User::findOrFail($id);
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
            $kelas = User::findOrFail($id);
            $name = $kelas->name;
            $adminrole = Role::where('name', '=', $kelas->username)->first();
            $this->hak_akses_save($adminrole);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Hak akses <b><i>' . $name . '</i></b> telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');
            $user = User::where('id','=',$id)->first();
            $username = $user->username;
            $adminrole = Role::where('name','=',$username)->first();

            if(!is_null($adminrole)) {
                $adminrole->revokePermission(Permission::all());
                $user->revokeRole($username);    
            }

            User::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Admin <b><i>' . $username . '</i></b> telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function check_password()
    {
        $cu = Auth::user()->getCU();
        $pass = Auth::user()->getPass(); 

        $password_now = Input::get('password_now');
        if (Hash::check($password_now, $pass))
            return Redirect::route('admins.'.$this->kelaspath.'.index');
        else
            return Redirect::back()->withInput()->with('errormessage', 'Password anda salah.');
    }

    public function hak_akses_save($adminrole)
    {
        $this->hak_akses('pengumuman','view',$adminrole);
        $this->hak_akses('pengumuman','create',$adminrole);
        $this->hak_akses('pengumuman','update',$adminrole);
        $this->hak_akses('pengumuman','update_urutan',$adminrole);
        $this->hak_akses('pengumuman','destroy',$adminrole);
        $this->hak_akses('saran','view',$adminrole);
        $this->hak_akses('saran','destroy',$adminrole);
        $this->hak_akses('statistikweb','view',$adminrole);
        $this->hak_akses('artikel','view',$adminrole);
        $this->hak_akses('artikel','create',$adminrole);
        $this->hak_akses('artikel','update',$adminrole);
        $this->hak_akses('artikel','update_status',$adminrole);
        $this->hak_akses('artikel','update_pilihan',$adminrole);
        $this->hak_akses('artikel','destroy',$adminrole);
        $this->hak_akses('kategoriartikel','view',$adminrole);
        $this->hak_akses('kategoriartikel','create',$adminrole);
        $this->hak_akses('kategoriartikel','update',$adminrole);
        $this->hak_akses('kategoriartikel','destroy',$adminrole);
        $this->hak_akses('kegiatan','view',$adminrole);
        $this->hak_akses('kegiatan','create',$adminrole);
        $this->hak_akses('kegiatan','update',$adminrole);
        $this->hak_akses('kegiatan','destroy',$adminrole);
        $this->hak_akses('kegiatandetail','view',$adminrole);
        $this->hak_akses('kegiatandetail','peserta',$adminrole);
        $this->hak_akses('kegiatandetail','biaya',$adminrole);
        $this->hak_akses('kegiatandetail','evaluasi',$adminrole);
        $this->hak_akses('cuprimer','view',$adminrole);
        $this->hak_akses('cuprimer','create',$adminrole);
        $this->hak_akses('cuprimer','update',$adminrole);
        $this->hak_akses('cuprimer','detail',$adminrole);
        $this->hak_akses('cuprimer','destroy',$adminrole);
        $this->hak_akses('tpcu','view',$adminrole);
        $this->hak_akses('tpcu','create',$adminrole);
        $this->hak_akses('tpcu','update',$adminrole);
        $this->hak_akses('tpcu','destroy',$adminrole);
        $this->hak_akses('wilayahcuprimer','view',$adminrole);
        $this->hak_akses('wilayahcuprimer','create',$adminrole);
        $this->hak_akses('wilayahcuprimer','update',$adminrole);
        $this->hak_akses('wilayahcuprimer','destroy',$adminrole);
        $this->hak_akses('laporancu','view',$adminrole);
        $this->hak_akses('laporancu','create',$adminrole);
        $this->hak_akses('laporancu','update',$adminrole);
        $this->hak_akses('laporancu','destroy',$adminrole);
        $this->hak_akses('laporancu','upload',$adminrole);
        $this->hak_akses('staf','view',$adminrole);
        $this->hak_akses('staf','create',$adminrole);
        $this->hak_akses('staf','update',$adminrole);
        $this->hak_akses('staf','destroy',$adminrole);
        $this->hak_akses('stafdetail','view',$adminrole);
        $this->hak_akses('stafdetail','riwayat',$adminrole);
        $this->hak_akses('stafdetail','kegiatan',$adminrole);
        $this->hak_akses('download','view',$adminrole);
        $this->hak_akses('download','create',$adminrole);
        $this->hak_akses('download','update',$adminrole);
        $this->hak_akses('download','destroy',$adminrole);
        $this->hak_akses('admin','view',$adminrole);
        $this->hak_akses('admin','create',$adminrole);
        $this->hak_akses('admin','update_password',$adminrole);
        $this->hak_akses('admin','update_akses',$adminrole);
        $this->hak_akses('admin','update_status',$adminrole);
        $this->hak_akses('admin','destroy',$adminrole);
        $this->hak_akses('admin','detail',$adminrole);
    }

    public function hak_akses($namaakses,$tipe,$adminrole){
        if(Input::get($namaakses.'_'.$tipe) == 1) {
            if (!$adminrole->can($tipe.'.'.$namaakses.'_'.$tipe)){
                $adminrole->assignPermission($namaakses.'_'.$tipe);
            }
        }else{
            if($adminrole->can($tipe.'.'.$namaakses.'_'.$tipe)){
                $adminrole->revokePermission($namaakses.'_'.$tipe);
            }
        }
    }
}