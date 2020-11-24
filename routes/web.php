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

//proses login
Route::get('/','AuthController@login')->name('login');
Route::post('/postLogin','AuthController@postLogin')->name('postLogin');
Route::get('/logout','AuthController@logout')->name('logout');

//registrasi karyawan
Route::post('/karyawan/create','KaryawanController@create')->name('karyawan/create');
Route::get('/registrasi',function(){
  return view('Auth.registrasi');
})->name('registrasi');

//middleware untuk Admin
Route::group(['middleware' => ['auth','CheckRole:admin']],  function (){
  //EOQ
  Route::get('/Eoq','AdEoqController@index')->name('eoq');
  Route::post('/Eoq/create','AdEoqController@create')->name('eoq/create');

  Route::get('/karyawan','KaryawanController@index')->name('karyawan');
  //order cost
  Route::get('/order_cost','OrderCostController@index')->name('order_cost');
  Route::post('/order_cost/create','OrderCostController@create')->name('order_cost/create');
  Route::get('/order_cost/destroy/{id}','OrderCostController@destroy')->name('order_cost/destroy');
  //carrying Cost
  Route::get('/carrying_cost','CarryingCostController@index')->name('carrying_cost');
  Route::post('/carrying_cost/create','CarryingCostController@create')->name('carrying_cost/create');
  Route::get('/carrying_cost/destroy/{id}','CarryingCostController@destroy')->name('carrying_cost/destroy');
});

//middleware untuk Karyawan
Route::group(['middleware' => ['auth','CheckRole:karyawan']],  function (){
  Route::get('/jadwal_karyawan','KarJadwalController@index')->name('jadwal_karyawan');
});

//middleware multiusers
Route::group(['middleware' => ['auth','CheckRole:admin,karyawan']],  function (){
  Route::get('/home','homeController@index')->name('home');
});
