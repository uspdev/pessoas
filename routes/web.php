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

Route::get('/', 'IndexController@index');

Route::get('login', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('callback', 'Auth\LoginController@handleProviderCallback');
Route::post('logout', 'Auth\LoginController@logout');
Route::get('logout', 'Auth\LoginController@logout');

# model Pessoa
Route::get('pessoas/{codpes}', 'PessoaController@show');
Route::post('pessoas', 'PessoaController@store');
Route::get('pessoas/{codpes}/edit', 'PessoaController@edit');
Route::patch('pessoas/{codpes}', 'PessoaController@update');

#buscas
Route::get('search', 'PessoaController@search');
Route::get('search/partenome', 'PessoaController@partenome')->name('autocomplete.search');

# model User
Route::resource('users', 'UserController');