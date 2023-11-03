<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::post('/simpanregistrasi', '\App\Http\Controllers\AuthController@simpanregistrasi')->name('simpanregistrasi');
Route::post('/postlogin','\App\Http\Controllers\AuthController@postlogin')->name('postlogin');
Route::get('/logout','\App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/','\App\Http\Controllers\AdminController@home')->name('home');
Route::get('/filterkategori','\App\Http\Controllers\AdminController@filterkategori')->name('filterkategori');


Route::group(['middleware' => ['auth','cekrole:Admin']],function(){

    Route::get('/dashboard/admin','\App\Http\Controllers\AdminController@index')->name('dashboard.admin');
    Route::get('/manage_user/admin','\App\Http\Controllers\AdminController@manageuser')->name('manageuser.admin');
    Route::get('/manage_transaksi/admin','\App\Http\Controllers\AdminController@managetransaksi')->name('managetransaksi.admin');
    
    Route::get('/manage_barang/admin','\App\Http\Controllers\AdminController@managebarang')->name('managebarang.admin');
    Route::post('/tambah_barang/admin','\App\Http\Controllers\AdminController@tambahbarang')->name('tambahbarang.admin');
    Route::post('/update_barang/admin/{id}','\App\Http\Controllers\AdminController@updatebarang')->name('updatebarang.admin');
    Route::get('/delete_barang/admin/{id}','\App\Http\Controllers\AdminController@deletebarang')->name('deletebarang.admin');
    
    Route::get('/manage_kategori/admin','\App\Http\Controllers\AdminController@managekategori')->name('managekategori.admin');
    Route::post('/tambah_kategori/admin','\App\Http\Controllers\AdminController@tambahkategori')->name('tambahkategori.admin');
    Route::post('/update_kategori/admin/{id}','\App\Http\Controllers\AdminController@updatekategori')->name('updatekategori.admin');
    Route::get('/delete_kategori/admin/{id}','\App\Http\Controllers\AdminController@deletekategori')->name('deletekategori.admin');
    
    Route::post('/updateUserRole/admin/{id}','\App\Http\Controllers\AdminController@updateUserRole')->name('updaterole.admin');
});  

Route::group(['middleware' => ['auth','cekrole:Customer,Customer_member']],function(){
    Route::get('/dashboard/customer','\App\Http\Controllers\CustomerController@index')->name('dashboard.customer');
    Route::get('/barang-detail/customer/{id}','\App\Http\Controllers\CustomerController@detailproduk')->name('detailproduk.customer');
    Route::post('/simpantransaksi/customer/{id}','\App\Http\Controllers\CustomerController@simpantransaksi')->name('simpantransaksi.customer');

});  
