<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',array( 'as' => 'home','uses' => 'PublicController@index'));
Route::get('pelayanan/{id}',array( 'as' => 'pelayanans','uses' => 'PublicController@solusi'));
Route::get('pelayanan',array( 'as' => 'pelayanan','uses' => 'PublicController@pelayanan'));
Route::get('kegiatan',array( 'as' => 'kegiatan','uses' => 'PublicController@agenda'));
Route::get('profil',array( 'as' => 'profil','uses' => 'PublicController@profil'));
Route::get('pengurus',array( 'as' => 'pengurus','uses' => 'PublicController@pengurus'));
Route::get('pengawas',array( 'as' => 'pengawas','uses' => 'PublicController@pengawas'));
Route::get('manajemen',array( 'as' => 'manajemen','uses' => 'PublicController@manajemen'));
Route::get('berita',array( 'as' => 'berita','uses' => 'PublicController@berita'));
Route::get('sejarah',array( 'as' => 'sejarah','uses' => 'PublicController@sejarah'));
Route::get('cuprimer',array('as' => 'cuprimer','uses' => 'PublicController@cuprimer'));
Route::get('cuprimer_detail/{id}',array( 'as' => 'cuprimer_detail','uses' => 'PublicController@cuprimer_detail'));
Route::get('hymnecu',array('as' => 'hymnecu','uses' => 'PublicController@hymnecu'));
Route::get('artikel/{id}',array( 'as' => 'artikel','uses' => 'PublicController@artikel'));
Route::get('artikel_detail/{id}',array( 'as' => 'artikel_detail','uses' => 'PublicController@artikel_detail'));
Route::get('filosofi',array( 'as' => 'filosofi','uses' => 'PublicController@filosofi'));
Route::get('cari',array('as' => 'cari','uses' => 'PublicController@getcari'));
Route::get('download',array('as' => 'download','uses' => 'PublicController@download'));
Route::get('download/{filename}',array('as' => 'file','uses' => 'PublicController@download_file'));
Route::get('attribution',array('as' => 'attribution','uses' => 'PublicController@attribution'));
Route::get('sitemap',array('as' => 'sitemap','uses' => 'PublicController@sitemap'));
Route::post('saran',array('as' => 'saran', 'uses' => 'PublicController@saran'));

Route::group(array('prefix' => 'cu'), function(){
    Route::get('login',array('as' => 'cu.login','uses' => 'AuthController@getLogin_public'));
    Route::post('login',array('as' =>'cu.login.post','uses' => 'AuthController@postLogin_public'));
    Route::get('logout',array('as' => 'cu.logout','uses' => 'AuthController@getLogout_public'));
});

Route::get('cu',array('as' => 'cu','middleware' => 'auth.public', function()
{
    return View::make('cu.index');
}));

Route::group(array('prefix'=>'cu','middleware' => 'auth.public'),function(){
    Route::get('edit_info',array('as' => 'cu.edit_info','uses' => 'CuprimerController@edit_info_public'));
    Route::get('edit_deskripsi',array('as' => 'cu.edit_deskripsi','uses' => 'CuprimerController@edit_deskripsi_public'));
    Route::post('update_info',array('as' => 'cu.update_info','uses' => 'CuprimerController@update_info_public'));
    Route::post('update_deskripsi',array('as' => 'cu.update_deskripsi','uses' => 'CuprimerController@update_deskripsi_public'));
    Route::get('kelola_kegiatan',array('as' => 'cu.kelola_kegiatan','uses' => 'KegiatanController@index_public'));
    Route::get('daftar_kegiatan/{id}',array('as' => 'cu.daftar_kegiatan','uses' => 'KegiatanController@daftar_kegiatan'));
    Route::get('kelola_staf',array('as' => 'cu.kelola_staf','uses' => 'StafController@index_public'));
    Route::get('create_staf',array('as' => 'cu.create_staf','uses' => 'StafController@create_public'));
    Route::get('detail_staf/{id}',array('as' => 'cu.detail_staf','uses' => 'StafController@detail_public'));
    Route::get('edit_staf/{id}',array('as' => 'cu.edit_staf','uses' => 'StafController@edit_public'));
    Route::delete('destroy_staf',array('as' => 'cu.destroy_staf','uses' => 'StafController@destroy_public'));
});

Route::group(array('prefix' => 'admins'), function(){
    Route::get('login',array('as' => 'admins.login','uses' => 'AuthController@getLogin'));
    Route::post('login',array('as' =>'admins.login.post','uses' => 'AuthController@postLogin'));
    Route::get('logout',array('as' => 'admins.logout','uses' => 'AuthController@getLogout'));
});

Route::get('admins',array('as' => 'admins','middleware' => 'auth', function()
{
    return view('admins.index');
}));

Route::group(array('prefix' => 'admins','middleware' => 'auth'), function(){
// artikel
    Route::get('artikel', [
        'as'           => 'admins.artikel.index',           
        'uses'         => 'ArtikelController@index',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.artikel_view']);
    Route::get('artikel/create', [
        'as'           => 'admins.artikel.create',
        'uses'         => 'ArtikelController@create',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.artikel_create']);
    Route::get('artikel/{artikel}/edit', [
        'as'           => 'admins.artikel.edit',
        'uses'         => 'ArtikelController@edit',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.artikel_update']);
    Route::post('artikel', [
        'as'           => 'admins.artikel.store',
        'uses'         => 'ArtikelController@store',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.artikel_create']);
    Route::put('artikel/{artikel}', [
        'as'           => 'admins.artikel.update',
        'uses'         => 'ArtikelController@update',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.artikel_update']);
    Route::delete('artikel/{artikel}', [
        'as'           => 'admins.artikel.destroy',
        'uses'         => 'ArtikelController@destroy',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.artikel_destroy']);
    Route::post('artikel/update_status', [
        'as'           => 'admins.artikel.update_status',
        'uses'         => 'ArtikelController@update_status',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update_kategori.artikel_update_status']);
    Route::post('artikel/update_pilihan', [
        'as'           => 'admins.artikel.update_pilihan',
        'uses'         => 'ArtikelController@update_pilihan',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update_kategori.artikel_update_pilihan']);
    Route::post('kategoriartikel', [
        'as'           => 'admins.kategoriartikel.store_kategori',
        'uses'         => 'ArtikelController@store_kategori',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.kategoriartikel_create']);
    Route::put('kategoriartikel/update2', [
        'as'           => 'admins.kategoriartikel.update_kategori',
        'uses'         => 'ArtikelController@update_kategori',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.kategoriartikel_update']);
    Route::delete('kategoriartikel/{kategoriartikel}', [
        'as'           => 'admins.kategoriartikel.destroy_kategori',
        'uses'         => 'ArtikelController@destroy_kategori',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.kategoriartikel_destroy']);
// curpimer
    Route::get('cuprimer', [
        'as'           => 'admins.cuprimer.index',           
        'uses'         => 'CuprimerController@index',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.cuprimer_view']);
    Route::get('cuprimer/create', [
        'as'           => 'admins.cuprimer.create',
        'uses'         => 'CuprimerController@create',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.cuprimer_create']);
    Route::get('cuprimer/{cuprimer}/edit', [
        'as'           => 'admins.cuprimer.edit',
        'uses'         => 'CuprimerController@edit',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.cuprimer_update']);
    Route::post('cuprimer', [
        'as'           => 'admins.cuprimer.store',
        'uses'         => 'CuprimerController@store',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.cuprimer_create']);
    Route::put('cuprimer/{cuprimer}', [
        'as'           => 'admins.cuprimer.update',
        'uses'         => 'CuprimerController@update',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.cuprimer_update']);
    Route::delete('cuprimer/{cuprimer}', [
        'as'           => 'admins.cuprimer.destroy',
        'uses'         => 'CuprimerController@destroy',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.cuprimer_destroy']);
    Route::post('wilayahcuprimer', [
        'as'           => 'admins.wilayahcuprimer.store_wilayah',
        'uses'         => 'CuprimerController@store_wilayah',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.wilayahcuprimer_create']);
    Route::put('wilayahcuprimer/update2', [
        'as'           => 'admins.wilayahcuprimer.update_wilayah',
        'uses'         => 'CuprimerController@update_wilayah',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.wilayahcuprimer_update']);
    Route::delete('wilayahcuprimer/{wilayahcuprimer}', [
        'as'           => 'admins.wilayahcuprimer.destroy_wilayah',
        'uses'         => 'CuprimerController@destroy_wilayah',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.wilayahcuprimer_destroy']);
//laporan CU
    Route::get('laporancu', [
        'as'           => 'admins.laporancu.index',           
        'uses'         => 'LaporanCuController@index',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.laporancu_view']);
    Route::get('laporancu/create', [
        'as'           => 'admins.laporancu.create',
        'uses'         => 'LaporanCuController@create',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.laporancu_create|create.laporancudetail_create']);
    Route::get('laporancu/{laporancu}/edit', [
        'as'           => 'admins.laporancu.edit',
        'uses'         => 'LaporanCuController@edit',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.laporancu_update|update.laporancudetail_update']);
    Route::post('laporancu', [
        'as'           => 'admins.laporancu.store',
        'uses'         => 'LaporanCuController@store',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.laporancu_create|create.laporancudetail_create']);
    Route::put('laporancu/{laporancu}', [
        'as'           => 'admins.laporancu.update',
        'uses'         => 'LaporanCuController@update',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.laporancu_update|update.laporancudetail_update']);
    Route::delete('laporancu/{laporancu}', [
        'as'           => 'admins.laporancu.destroy',
        'uses'         => 'LaporanCuController@destroy',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.laporancu_destroy|destroy.laporancudetail_destroy']);
    Route::post('laporancu/importexcel', [
        'as'           => 'admins.laporancu.importexcel',
        'uses'         => 'LaporanCuController@importexcel',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.laporancu_upload']);
    Route::get('laporancu/index_periode/{periode}', [
        'as'           => 'admins.laporancu.index_periode',
        'uses'         => 'LaporanCuController@index_periode',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.laporancu_view']);
    Route::get('laporancu/index_bkcu', [
        'as'           => 'admins.laporancu.index_bkcu',
        'uses'         => 'LaporanCuController@index_bkcu',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.laporanbkcu_view']);
    Route::get('laporancu/index_cu/{id}', [
        'as'           => 'admins.laporancu.index_cu',
        'uses'         => 'LaporanCuController@index_cu',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.laporancudetail_view']);
//tp CU
    Route::get('tpcu', [
        'as'           => 'admins.tpcu.index',           
        'uses'         => 'TpcuController@index',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.tpcu_view']);
    Route::get('tpcu/create', [
        'as'           => 'admins.tpcu.create',
        'uses'         => 'TpcuController@create',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.tpcu_create']);
    Route::get('tpcu/{tpcu}/edit', [
        'as'           => 'admins.tpcu.edit',
        'uses'         => 'TpcuController@edit',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.tpcu_update']);
    Route::post('tpcu', [
        'as'           => 'admins.tpcu.store',
        'uses'         => 'TpcuController@store',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.tpcu_create']);
    Route::put('tpcu/{tpcu}', [
        'as'           => 'admins.tpcu.update',
        'uses'         => 'TpcuController@update',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.tpcu_update']);
    Route::delete('tpcu/{tpcu}', [
        'as'           => 'admins.tpcu.destroy',
        'uses'         => 'TpcuController@destroy',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.tpcu_destroy']);
     Route::get('tpcu/index_cu/{id}', [
        'as'           => 'admins.tpcu.index_cu',           
        'uses'         => 'TpcuController@index_cu',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.tpcu_view']);
// staf
    Route::get('staf', [
        'as'           => 'admins.staf.index',           
        'uses'         => 'StafController@index',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.staf_view']);
    Route::get('staf/create', [
        'as'           => 'admins.staf.create',
        'uses'         => 'StafController@create',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.staf_create']);
    Route::get('staf/{staf}/edit', [
        'as'           => 'admins.staf.edit',
        'uses'         => 'StafController@edit',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.staf_update']);
    Route::post('staf', [
        'as'           => 'admins.staf.store',
        'uses'         => 'StafController@store',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.staf_create']);
    Route::put('staf/{staf}', [
        'as'           => 'admins.staf.update',
        'uses'         => 'StafController@update',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.staf_update']);
    Route::delete('staf/{staf}', [
        'as'           => 'admins.staf.destroy',
        'uses'         => 'StafController@destroy',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.staf_destroy']);
    Route::get('staf/allstaf',array(
        'as' => 'admins.staf.allstaf',
        'uses' => 'StafController@allstaf'
    ));
    Route::get('staf/index_cu/{$id}', [
        'as'           => 'admins.staf.index_cu',
        'uses'         => 'StafController@index_cu',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.staf_view']);
    Route::get('staf/index_cu/{id}',array(
        'as' => 'admins.staf.index_cu',
        'uses' => 'StafController@index_cu'));
    Route::get('staf/{id}/detail',array(
        'as' => 'admins.staf.detail',
        'uses' => 'StafController@detail'
    ));
    Route::post('staf/riwayat',array(
        'as' => 'admins.staf.riwayat',
        'uses' => 'StafController@riwayat'
    ));
    Route::post('staf/update_riwayat',array(
        'as' => 'admins.staf.update_riwayat',
        'uses' => 'StafController@update_riwayat'
    ));
    Route::post('staf/destroy_riwayat',array(
        'as' => 'admins.staf.destroy_riwayat',
        'uses' => 'StafController@destroy_riwayat'
    ));
    Route::post('staf/update_jabatan',array(
        'as' => 'admins.staf.update_jabatan',
        'uses' => 'StafController@update_jabatan'
    ));
    Route::post('staf/update_tingkat',array(
        'as' => 'admins.staf.update_tingkat',
        'uses' => 'StafController@update_tingkat'
    ));
    Route::post('staf/update_cu',array(
        'as' => 'admins.staf.update_cu',
        'uses' => 'StafController@update_cu'
    ));
// pengumuman
    // Route::resource('pengumuman','PengumumanController',array('except' => array('show','create','edit')));
    Route::get('pengumuman', [
        'as'           => 'admins.pengumuman.index',           
        'uses'         => 'PengumumanController@index',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.pengumuman_view']);
    Route::post('pengumuman', [
        'as'           => 'admins.pengumuman.store',
        'uses'         => 'PengumumanController@store',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.pengumuman_create']);
    Route::put('pengumuman/{pengumuman}', [
        'as'           => 'admins.pengumuman.update',
        'uses'         => 'PengumumanController@update',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.pengumuman_update']);
    Route::delete('pengumuman/{pengumuman}', [
        'as'           => 'admins.pengumuman.destroy',
        'uses'         => 'PengumumanController@destroy',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.pengumuman_destroy']);
    Route::post('pengumuman/update_urutan', [
        'as'           => 'admins.pengumuman.update_urutan',
        'uses'         => 'PengumumanController@update_urutan',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update_urutan.pengumuman_update_urutan']);

// user
    Route::resource('admin','UserController',array('except' => array('show','edit')));    
    Route::get('admin/edit_akses/{id}',array(
        'as' => 'admins.admin.edit_akses',
        'uses' => 'UserController@edit_akses'
    ));
    Route::post('admin/update_akses',array(
        'as' => 'admins.admin.update_akses',
        'uses' => 'UserController@update_akses'
    ));
    Route::post('admin/update_status',array(
        'as' => 'admins.admin.update_status',
        'uses' => 'UserController@update_status'
    ));
    Route::post('admin/update_password',array(
        'as' => 'admins.admin.update_password',
        'uses' => 'UserController@update_password'
    ));
// kegiatan
     Route::get('kegiatan', [
        'as'           => 'admins.kegiatan.index',           
        'uses'         => 'KegiatanController@index',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'view.kegiatan_view']);
    Route::get('kegiatan/create', [
        'as'           => 'admins.kegiatan.create',
        'uses'         => 'KegiatanController@create',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.kegiatan_create']);
    Route::get('kegiatan/{kegiatan}/edit', [
        'as'           => 'admins.kegiatan.edit',
        'uses'         => 'KegiatanController@edit',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.kegiatan_update']);
    Route::post('kegiatan', [
        'as'           => 'admins.kegiatan.store',
        'uses'         => 'KegiatanController@store',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'create.kegiatan_create']);
    Route::put('kegiatan/{kegiatan}', [
        'as'           => 'admins.kegiatan.update',
        'uses'         => 'KegiatanController@update',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'update.kegiatan_update']);
    Route::delete('kegiatan/{kegiatan}', [
        'as'           => 'admins.kegiatan.destroy',
        'uses'         => 'KegiatanController@destroy',
        'middleware'   => ['auth', 'acl'],
        'can'          => 'destroy.kegiatan_destroy']);
    Route::get('kegiatan/{id}/detail',array(
        'as' => 'admins.kegiatan.detail',
        'uses' => 'KegiatanController@detail'
    ));
    Route::post('kegiatan/update_tujuan',array(
        'as' => 'admins.kegiatan.update_tujuan',
        'uses' => 'KegiatanController@update_tujuan'
    ));
    Route::post('kegiatan/update_pokok',array(
        'as' => 'admins.kegiatan.update_pokok',
        'uses' => 'KegiatanController@update_pokok'
    ));
    Route::get('kegiatan/getselect2',array(
        'as' => 'admins.kegiatan.getselect2',
        'uses' => 'KegiatanController@getselect2'
    ));
// statisitik
    Route::get('statistik',array('as' => 'statistik', function()
    {
        $statistiks = DB::table('stat_pengunjung')
                        ->orderBy('tanggal', 'desc')
                        ->paginate(20);

        return View::make('admins.statistik',compact('statistiks'));
    }));
// infogerakaan
    Route::resource('infogerakan','AdminInfoGerakanController',array('only' => array('edit','update')));
//download, kategori artikel, wilayah cu primer, saran
    Route::resource('download','DownloadController',array('except' => array('show')));
    Route::resource('saran','SaranController',array('except' => array('show','create','edit',)));
//version
    Route::get('version',array('as' => 'admins.version', function()
    {
        return View::make('admins.about.version');
    }));
});

    


Route::get('importexport', function()
{
    return view('importExport');
});

Route::get('importExport', 'ExcelController@importExport');
Route::get('downloadExcel/{type}', 'ExcelController@downloadExcel');
Route::post('importExcel', 'ExcelController@importExcel');
Route::get('/getreq',function (){
   if(Request::ajax()){
       return 'get request loaded';
   }
});
Route::post('/register',function (){
    if(Request::ajax()){
        return Response::json(Request::all());
    }
});



//echo '<pre>';
//echo var_dump($datacu->staf);
//echo '<pre>';

Route::get('/getrole',function(){
    $role = App\Models\Role::with('perms')->findOrFail('2');
});

Route::get('/addrole',function(){
    
    // $roleAdmin = new Kodeine\Acl\Models\Eloquent\Role();
    // $roleAdmin->name = 't0n1zz';
    // $roleAdmin->slug = 't0n1zz';
    // $roleAdmin->description = 'i am alpha and omega of this site';
    // $roleAdmin->save();

    // $user = App\Models\User::find(1);
    // $user->assignRole($roleAdmin);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => 'artikel',
    //     'slug'        => [          // pass an array of permissions.
    //         'create'     => true,
    //         'view'       => true,
    //         'update'     => true,
    //         'delete'     => true,
    //         'update_status' => true,
    //         'update_pilihan' => true,
    //     ],
    //     'description' => 'Mengatur akses artikel'
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => 'artikel',
    //     'slug'        => [          // pass an array of permissions.
    //         'update_status'     => true,
    //     ],
    //     'description' => 'update status artikel'
    // ]);

    // $class = 'tpcu';

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_view',
    //     'slug'        => [ 
    //         'view' => true,
    //     ],
    //     'description' => 'View '.$class
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_create',
    //     'slug'        => [ 
    //         'create' => true,
    //     ],
    //     'description' => 'Create '.$class
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_update',
    //     'slug'        => [ 
    //         'update' => true,
    //     ],
    //     'description' => 'Update '.$class
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_destroy',
    //     'slug'        => [ 
    //         'destroy' => true,
    //     ],
    //     'description' => 'Destroy '.$class
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_update_akses',
    //     'slug'        => [ 
    //         'update_akses' => true,
    //     ],
    //     'description' => 'Update akses '.$class
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_update_password',
    //     'slug'        => [ 
    //         'update_password' => true,
    //     ],
    //     'description' => 'Update password '.$class
    // ]);

    // $class = 'kegiatandetail';
    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_view',
    //     'slug'        => [ 
    //         'view' => true,
    //     ],
    //     'description' => 'View '.$class
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_peserta',
    //     'slug'        => [ 
    //         'peserta' => true,
    //     ],
    //     'description' => 'Peserta '.$class
    // ]);


    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_update',
    //     'description' => 'Mengubah data '.$class
    // ]);

    // $permission = new Kodeine\Acl\Models\Eloquent\Permission();
    // $permUser = $permission->create([ 
    //     'name'        => $class.'_destroy',
    //     'description' => 'Menghapus data '.$class
    // ]);

    // $roleAdmin = Kodeine\Acl\Models\Eloquent\Role::where('name','=','user_1');
    // $roleAdmin->assignPermission('article_view');   
    // $roleAdmin->assignPermission(Kodeine\Acl\Models\Eloquent\Permission::all());

    // $roleAdmin->revokePermission('pengumuman_view');

    // $admin = Kodeine\Acl\Models\Eloquent\Role::first();
    // if(!$admin->can('view.pengumuman_view'))
    //     echo "yuhu";
    // else
    //     echo "oh no";

    // $admin = App\Models\User::find(1);
    // $admin->addPermission('update_artikel');
    // $admin->removePermission('create_user');
    // $kelas = App\Models\User::findOrFail('1');
    // $adminrole = Kodeine\Acl\Models\Eloquent\Role::where('name', '=', $kelas->username)->first();
    // $adminrole->revokePermission('artikel_update');
});
