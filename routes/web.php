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
  Route::get('/Eoq/destroy/{id}','AdEoqController@destroy')->name('eoq/destroy');

  //Karyawan
  Route::get('/karyawan','KaryawanController@index')->name('karyawan');
  Route::patch('/karyawan/update','KaryawanController@update')->name('karyawan/update');
  Route::get('/karyawan/destroy/{id}','KaryawanController@destroy')->name('karyawan/destroy');

  //order cost
  Route::get('/order_cost','OrderCostController@index')->name('order_cost');
  Route::post('/order_cost/create','OrderCostController@create')->name('order_cost/create');
  Route::get('/order_cost/destroy/{id}','OrderCostController@destroy')->name('order_cost/destroy');
  //carrying Cost
  Route::get('/carrying_cost','CarryingCostController@index')->name('carrying_cost');
  Route::post('/carrying_cost/create','CarryingCostController@create')->name('carrying_cost/create');
  Route::get('/carrying_cost/destroy/{id}','CarryingCostController@destroy')->name('carrying_cost/destroy');
  //produk
  Route::get('/produk','ProdukController@index')->name('produk');
  Route::post('/produk/create','ProdukController@create')->name('produk/create');
  Route::patch('/produk/update','ProdukController@update')->name('produk/update');
  Route::get('/produk/destroy/{id}','ProdukController@destroy')->name('produk/destroy');
});

//middleware untuk Karyawan
Route::group(['middleware' => ['auth','CheckRole:karyawan']],  function (){
  //Profile
  Route::get('/profile/{id}','Karyawan\ProfileController@index')->name('profile');

  //jadwal produksi
  Route::get('/jadwal_karyawan','KarJadwalController@index')->name('jadwal_karyawan');

  //produksi
  Route::get('/produksi','Karyawan\ProduksiController@index')->name('produksi');
  Route::patch('/produksi/create','Karyawan\ProduksiController@create')->name('produksi/create');
});

//middleware multiusers
Route::group(['middleware' => ['auth','CheckRole:admin,karyawan']],  function (){
  Route::get('/home','homeController@index')->name('home');
});
