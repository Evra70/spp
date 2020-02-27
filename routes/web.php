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

//Proses
Route::post('/proses/addPetugas','PetugasController@prosesAddPetugas')->middleware('auth:admin');
Route::get('/proses/{id_petugas}/deletePetugas','PetugasController@deletePetugas')->middleware('auth:admin');
Route::get('/proses/{id_petugas}/formEditPetugas','PetugasController@formEditPetugas')->middleware('auth:admin');
Route::post('/proses/editPetugas','PetugasController@prosesEditPetugas')->middleware('auth:admin');
