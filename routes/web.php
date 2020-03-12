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

Route::get('/', 'MenuController@index')->middleware('guest');

Route::post('/loginSiswa','LoginController@loginSiswa')->middleware('guest');
Route::post('/loginPetugas','LoginController@loginPetugas')->middleware('guest');
Route::get('/admin','MenuController@home')->middleware('auth:admin');
Route::get('/petugas','MenuController@home')->middleware('auth:petugas');
Route::get('/siswa','MenuController@home')->middleware('auth:siswa');
Route::get('/prosesLogout','LoginController@logout')->middleware('auth:admin,petugas,siswa');

//Menu List
Route::get('/menu/petugasList','MenuController@petugasList')->middleware('auth:admin');
Route::get('/menu/siswaList','MenuController@siswaList')->middleware('auth:admin');
Route::get('/menu/kelasList','MenuController@kelasList')->middleware('auth:admin');
Route::get('/menu/formAddPetugas','MenuController@formAddPetugas')->middleware('auth:admin');
Route::get('/menu/formAddSiswa','MenuController@formAddSiswa')->middleware('auth:admin');
Route::get('/menu/formAddKelas','MenuController@formAddKelas')->middleware('auth:admin');
Route::get('/menu/transaksi','MenuController@transaksiSiswaList')->middleware('auth:admin');
Route::get('/menu/kenaikanKelas','MenuController@kenaikanKelasList')->middleware('auth:admin');

//Proses
Route::post('/proses/addPetugas','PetugasController@prosesAddPetugas')->middleware('auth:admin');
Route::get('/proses/{id_petugas}/deletePetugas','PetugasController@deletePetugas')->middleware('auth:admin');
Route::get('/proses/{id_petugas}/formEditPetugas','PetugasController@formEditPetugas')->middleware('auth:admin');
Route::post('/proses/editPetugas','PetugasController@prosesEditPetugas')->middleware('auth:admin');
Route::post('/proses/addSiswa','SiswaController@prosesAddSiswa')->middleware('auth:admin');
Route::get('/proses/{id_siswa}/deleteSiswa','SiswaController@deleteSiswa')->middleware('auth:admin');
Route::get('/proses/{id_siswa}/formEditSiswa','SiswaController@formEditSiswa')->middleware('auth:admin');
Route::post('/proses/editSiswa','SiswaController@prosesEditSiswa')->middleware('auth:admin');
Route::post('/proses/addKelas','KelasController@prosesAddKelas')->middleware('auth:admin');
Route::get('/proses/{id_kelas}/deleteKelas','KelasController@deleteKelas')->middleware('auth:admin');
Route::get('/proses/{id_kelas}/formEditKelas','KelasController@formEditKelas')->middleware('auth:admin');
Route::post('/proses/editKelas','KelasController@prosesEditKelas')->middleware('auth:admin');
Route::get('/proses/{id_siswa}/formPembayaran','TransaksiController@formPembayaran')->middleware('auth:admin');
Route::get('/proses/{id_pembayaran}/{id_siswa}/pembayaran','TransaksiController@prosesPembayaranSpp')->middleware('auth:admin');
Route::post('/proses/editPembayaranSiswa','TransaksiController@editPembayaranSiswa')->middleware('auth:admin');
Route::get('/proses/{id_pembayaran}/{id_siswa}/batalPembayaran','TransaksiController@prosesBatalPembayaranSpp')->middleware('auth:admin');
