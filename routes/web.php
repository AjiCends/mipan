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
  Route::get('/order_cost/destroy/{id}/{count?}','OrderCostController@destroy')->name('order_cost/destroy');
  Route::get('/order_cost/edit/{id?}','OrderCostController@edit')->name('order_cost/edit');
  Route::post('/order_cost/update','OrderCostController@update')->name('order_cost/update');
  //carrying Cost
  Route::get('/carrying_cost','CarryingCostController@index')->name('carrying_cost');
  Route::post('/carrying_cost/create','CarryingCostController@create')->name('carrying_cost/create');
  Route::get('/carrying_cost/destroy/{id}/{count?}','CarryingCostController@destroy')->name('carrying_cost/destroy');
  Route::get('/carrying_cost/edit/{id?}','CarryingCostController@edit')->name('carrying_cost/edit');
  Route::post('/carrying_cost/update','CarryingCostController@update')->name('carrying_cost/update');
  //produk
  Route::get('/produk','ProdukController@index')->name('produk');
  Route::post('/produk/create','ProdukController@create')->name('produk/create');
  Route::patch('/produk/update','ProdukController@update')->name('produk/update');
  Route::get('/produk/destroy/{id}','ProdukController@destroy')->name('produk/destroy');
  //Penjadwalan
  Route::post('/jadwal/create','JadwalProduksiController@create')->name('jadwal/create');

});

//middleware untuk Karyawan
Route::group(['middleware' => ['auth','CheckRole:karyawan']],  function (){
  //Profile
  Route::get('/profile/{id}','Karyawan\ProfileController@index')->name('profile');
  Route::patch('/profile/update','Karyawan\ProfileController@update')->name('profile/update');

  //produksi
  Route::get('/produksi','Karyawan\ProduksiController@index')->name('produksi');
  Route::patch('/produksi/create','Karyawan\ProduksiController@create')->name('produksi/create');
  Route::get('/produksi/show','Karyawan\ProduksiController@show')->name('produksi/show');
});

//middleware multiusers
Route::group(['middleware' => ['auth','CheckRole:admin,karyawan']],  function (){
  Route::get('/home','homeController@index')->name('home');

  //Penjadwalan
  Route::post('/jadwal/update','JadwalProduksiController@update')->name('jadwal/update');
  Route::get('/jadwal/{status?}','JadwalProduksiController@index')->name('jadwal');

  //Inventaris
  Route::get('/inventaris','InventarisController@index')->name('inventaris');
  Route::post('/inventaris/create','InventarisController@create')->name('inventaris/create');
  Route::patch('/inventaris/update','InventarisController@update')->name('inventaris/update');
  Route::get('/inventaris/destroy/{id}','InventarisController@destroy')->name('inventaris/destroy');

});
