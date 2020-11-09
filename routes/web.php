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
// Route::get('/', function ()
// {
//   return view('welcome');
// });
// Route::get('/nav', function(){
//   return view('tamplate\admin\nav');
// });

Route::get('/','AuthController@login')->name('login');
Route::post('/postLogin','AuthController@postLogin');
Route::get('/logout','AuthController@logout');

Route::post('/karyawan/create','KaryawanController@create');
Route::get('/registrasi',function(){
  return view('Auth.registrasi');
});

Route::group(['middleware' => ['auth','CheckRole:admin']],  function (){
  Route::get('/Eoq','AdEoqController@index');
  Route::get('/karyawan','KaryawanController@index');
});

Route::group(['middleware' => ['auth','CheckRole:karyawan']],  function (){
  Route::get('/jadwal-karyawan','KarJadwalController@index');
});

Route::group(['middleware' => ['auth','CheckRole:admin,karyawan']],  function (){
  Route::get('/home','homeController@index');
});
