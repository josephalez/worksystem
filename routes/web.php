<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::group(['middleware' => 'auth'], function(){  });

Route::get('/organization', function () {
  return view('organizations');
});//->middleware('auth');
Route::get('/assist', function () {
  return view('assist');
});
Route::get('/boton', function () {
  return view('boton');
});
Route::get('/', function () {
  return view('login');
});
Route::get('/coso', function () {
  $member = App\Member::find(1);
  if (!$member) return response('Webo',401);
  return $member->projects;
});


Route::get('/estados', 'EstadoController@tomar');
