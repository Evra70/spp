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
Route::get('/siswa','MenuController@home')->middleware('auth:siswa');
Route::get('/prosesLogout','LoginController@logout')->middleware('auth:admin,petugas,siswa');
