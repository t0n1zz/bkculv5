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
    Route::get('login',array('as' => 'cu.login','uses' => 'AdminAuthController@getLogin_public'));
    Route::post('login',array('as' =>'cu.login.post','uses' => 'AdminAuthController@postLogin_public'));
    Route::get('logout',array('as' => 'cu.logout','uses' => 'AdminAuthController@getLogout_public'));
});

Route::get('cu',array('as' => 'cu','middleware' => 'auth.public', function()
{
    return View::make('cu.index');
}));

Route::group(array('prefix'=>'cu','middleware' => 'auth.public'),function(){
    Route::get('edit_info',array('as' => 'cu.edit_info','uses' => 'AdminCuprimerController@edit_info_public'));
    Route::get('edit_deskripsi',array('as' => 'cu.edit_deskripsi','uses' => 'AdminCuprimerController@edit_deskripsi_public'));
    Route::post('update_info',array('as' => 'cu.update_info','uses' => 'AdminCuprimerController@update_info_public'));
    Route::post('update_deskripsi',array('as' => 'cu.update_deskripsi','uses' => 'AdminCuprimerController@update_deskripsi_public'));
    Route::get('kelola_kegiatan',array('as' => 'cu.kelola_kegiatan','uses' => 'AdminKegiatanController@index_public'));
    Route::get('daftar_kegiatan/{id}',array('as' => 'cu.daftar_kegiatan','uses' => 'AdminKegiatanController@daftar_kegiatan'));
    Route::get('kelola_staf',array('as' => 'cu.kelola_staf','uses' => 'AdminStafController@index_public'));
    Route::get('create_staf',array('as' => 'cu.create_staf','uses' => 'AdminStafController@create_public'));
    Route::get('detail_staf/{id}',array('as' => 'cu.detail_staf','uses' => 'AdminStafController@detail_public'));
    Route::get('edit_staf/{id}',array('as' => 'cu.edit_staf','uses' => 'AdminStafController@edit_public'));
    Route::delete('destroy_staf',array('as' => 'cu.destroy_staf','uses' => 'AdminStafController@destroy_public'));
});

Route::group(array('prefix' => 'admins'), function(){
    Route::get('login',array('as' => 'admins.login','uses' => 'AdminAuthController@getLogin'));
    Route::post('login',array('as' =>'admins.login.post','uses' => 'AdminAuthController@postLogin'));
    Route::get('logout',array('as' => 'admins.logout','uses' => 'AdminAuthController@getLogout'));
});

Route::get('admins',array('as' => 'admins','middleware' => 'auth', function()
{
    return view('admins.index');
}));

Route::group(array('prefix' => 'admins','middleware' => 'auth'), function(){
// artikel
    Route::resource('artikel','AdminArtikelController',array('except' => array('show')));
    Route::get('artikel/index_kategori/{id}',array(
        'as' => 'admins.artikel.index_kategori',
        'uses' => 'AdminArtikelController@index_kategori'
    ));
    Route::post('artikel/update_kategori',array(
        'as' => 'admins.artikel.update_kategori',
        'uses' => 'AdminArtikelController@update_kategori'
    ));
    Route::get('artikel/update_status/{id}',array(
        'as' => 'admins.artikel.update_status',
        'uses' => 'AdminArtikelController@update_status'
    ));
    Route::get('artikel/update_pilihan/{id}',array(
        'as' => 'admins.artikel.update_pilihan',
        'uses' => 'AdminArtikelController@update_pilihan'
    ));
// curpimer       
    Route::resource('cuprimer','AdminCuprimerController',array('except' => array('show')));
    Route::get('cuprimer/index_wilayah/{id}',array(
        'as' => 'admins.cuprimer.index_wilayah',
        'uses' => 'AdminCuprimerController@index_wilayah'
    ));
    Route::post('cuprimer/update_wilayah',array(
        'as' => 'admins.cuprimer.update_wilayah',
        'uses' => 'AdminCuprimerController@update_wilayah'
    ));
    Route::post('cuprimer/update_berdiri',array(
        'as' => 'admins.cuprimer.update_berdiri',
        'uses' => 'AdminCuprimerController@update_berdiri'
    ));
    Route::post('cuprimer/update_bergabung',array(
        'as' => 'admins.cuprimer.update_bergabung',
        'uses' => 'AdminCuprimerController@update_bergabung'
    ));
//perkembangan CU
    Route::resource('perkembangancu','AdminPerkembangancuController',array('except' => array('show')));
    Route::post('perkembangancu/importexcel',array(
        'as' => 'admins.perkembangancu.importexcel',
        'uses' => 'AdminPerkembangancuController@importexcel'
    ));
    Route::get('perkembangancu/index_cu/{id}',array(
        'as' => 'admins.perkembangancu.index_cu',
        'uses' => 'AdminPerkembangancuController@index_cu'));
    Route::get('perkembangancu/index_periode/{periode}',array(
        'as' => 'admins.perkembangancu.index_periode',
        'uses' => 'AdminPerkembangancuController@index_periode'));
//tp CU
    Route::resource('tpcu','AdminTpcuController',array('except' => array('show')));
    Route::get('tpcu/index_cu/{id}',array(
        'as' => 'admins.tpcu.index_cu',
        'uses' => 'AdminTpcuController@index_cu'));
// staf    
    Route::resource('staf','AdminStafController',array('except' => array('show')));
    Route::get('staf/index_bkcu',array(
        'as' => 'admins.staf.index_bkcu',
        'uses' => 'AdminStafController@index_bkcu'
    ));
    Route::get('staf/allstaf',array(
        'as' => 'admins.staf.allstaf',
        'uses' => 'AdminStafController@allstaf'
    ));
    Route::get('staf/index_cu/{id}',array(
        'as' => 'admins.staf.index_cu',
        'uses' => 'AdminStafController@index_cu'));
    Route::get('staf/{id}/detail',array(
        'as' => 'admins.staf.detail',
        'uses' => 'AdminStafController@detail'
    ));
    Route::post('staf/riwayat',array(
        'as' => 'admins.staf.riwayat',
        'uses' => 'AdminStafController@riwayat'
    ));
    Route::post('staf/update_riwayat',array(
        'as' => 'admins.staf.update_riwayat',
        'uses' => 'AdminStafController@update_riwayat'
    ));
    Route::post('staf/destroy_riwayat',array(
        'as' => 'admins.staf.destroy_riwayat',
        'uses' => 'AdminStafController@destroy_riwayat'
    ));
    Route::post('staf/update_jabatan',array(
        'as' => 'admins.staf.update_jabatan',
        'uses' => 'AdminStafController@update_jabatan'
    ));
    Route::post('staf/update_tingkat',array(
        'as' => 'admins.staf.update_tingkat',
        'uses' => 'AdminStafController@update_tingkat'
    ));
    Route::post('staf/update_cu',array(
        'as' => 'admins.staf.update_cu',
        'uses' => 'AdminStafController@update_cu'
    ));
// pengumuman
    Route::resource('pengumuman','AdminPengumumanController',array('except' => array('show','create','edit')));
    Route::post('pengumuman/update_urutan',array(
        'as' => 'admins.pengumuman.update_urutan',
        'uses' => 'AdminPengumumanController@update_urutan'
    ));
// admin
    Route::resource('admin','AdminAdminController',array('except' => array('show')));
    Route::get('admin/edit_password/{id}',array(
        'as' => 'admins.admin.edit_password',
        'uses' => 'AdminAdminController@edit_password'
    ));
    Route::get('admin/edit_akses/{id}',array(
        'as' => 'admins.admin.edit_akses',
        'uses' => 'AdminAdminController@edit_akses'
    ));
    Route::post('admin/update_akses/{id}',array(
        'as' => 'admins.admin.update_akses',
        'uses' => 'AdminAdminController@update_akses'
    ));
    Route::get('admin/update_status/{id}',array(
        'as' => 'admins.admin.update_status',
        'uses' => 'AdminAdminController@update_status'
    ));
    Route::post('admin/update_password/{id}',array(
        'as' => 'admins.admin.update_password',
        'uses' => 'AdminAdminController@update_password'
    ));
// kegiatan
    Route::resource('kegiatan','AdminKegiatanController',array('except' => array('show')));
    Route::post('kegiatan/update_mulai',array(
        'as' => 'admins.kegiatan.update_mulai',
        'uses' => 'AdminKegiatanController@update_mulai'
    ));
    Route::post('kegiatan/update_selesai',array(
        'as' => 'admins.kegiatan.update_selesai',
        'uses' => 'AdminKegiatanController@update_selesai'
    ));
    Route::get('kegiatan/{id}/detail',array(
        'as' => 'admins.kegiatan.detail',
        'uses' => 'AdminKegiatanController@detail'
    ));
    Route::post('kegiatan/update_tujuan',array(
        'as' => 'admins.kegiatan.update_tujuan',
        'uses' => 'AdminKegiatanController@update_tujuan'
    ));
    Route::post('kegiatan/update_pokok',array(
        'as' => 'admins.kegiatan.update_pokok',
        'uses' => 'AdminKegiatanController@update_pokok'
    ));
    Route::get('kegiatan/getselect2',array(
        'as' => 'admins.kegiatan.getselect2',
        'uses' => 'AdminKegiatanController@getselect2'
    ));
// statisitik
    Route::get('statistik',array('as' => 'statistik', function()
    {
        $statistiks = DB::table('stat_pengunjung')
                        ->orderBy('tanggal', 'desc')
                        ->paginate(20);

        return View::make('admins.statistik',compact('statistiks'));
    }));
// infogerkaan
    Route::resource('infogerakan','AdminInfoGerakanController',array('only' => array('edit','update')));
    Route::post('infogerakan/index_litbang',array(
        'as' => 'admins.infogerakan.index_litbang',
        'uses' => 'AdminInfoGerakanController@index_litbang'
    ));
    Route::post('infogerakan/create_litbang',array(
        'as' => 'admins.infogerakan.create_litbang',
        'uses' => 'AdminInfoGerakanController@create_litbang'
    ));
//download, kategori artikel, wilayah cu primer, saran
    Route::resource('download','AdminDownloadController',array('except' => array('show')));
    Route::resource('kategoriartikel','AdminKategoriArtikelController',array('except' => array('show','create','edit')));
    Route::resource('wilayahcuprimer','AdminWilayahCuprimerController',array('except' => array('show','create','edit')));
    Route::resource('saran','AdminSaranController',array('except' => array('show','create','edit',)));
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