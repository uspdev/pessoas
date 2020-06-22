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

Route::get('/', 'indexController@index');

Route::get('login', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('callback', 'Auth\LoginController@handleProviderCallback');
Route::post('logout', 'Auth\LoginController@logout');
Route::get('logout', 'Auth\LoginController@logout');

#busca por número USP
Route::get('buscas/codpes', function () {
        return view('buscas.codpes');
})->middleware('auth');
Route::post('buscas/codpes', 'BuscaController@codpes');

#busca por nome
Route::get('buscas/nompes', function () {
        return view('buscas.nompes');
})->middleware('auth');
Route::get('buscas/partenome', 'BuscaController@partenome')->name('autocomplete.search');
