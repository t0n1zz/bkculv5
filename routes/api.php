<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/api_test', function(Request $request){
	$judul = $request->json()->get('judul');
	$konten = $request->json()->get('content');

	$artikel = new App\Artikel;
	$artikel->judul = $judul;
	$artikel->content = $konten;

	$artikel->save();
});

Route::get('/api_get', function (Request $request) {
    return response()
    ->json([
        'authenticated' => true
    ]);
});
