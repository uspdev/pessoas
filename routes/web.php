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
Route::get('buscas/codpes/{codpes}', 'PessoaController@show');
#Route::post('buscas/codpes', 'PessoaController@codpes');

#Route::get('buscas/codpes_form', 'PessoaController@form_codpes');
#
#Route::get('buscas/codpes', 'PessoaController@show');

#busca por nome
Route::get('buscas/nompes', 'PessoaController@form_nompes');
Route::get('buscas/partenome', 'PessoaController@partenome')->name('autocomplete.search');

#rotas dos campos extras
Route::get('campos_extras/{codpes}', 'CamposExtrasController@edit');
Route::post('campos_extras/{codpes}', 'CamposExtrasController@update');