<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\UserController;

Route::get('/', [IndexController::class, 'index']);

Route::get('login', [LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
#Route::get('logout', 'LoginController@logout');

# model Pessoa
Route::get('pessoas/{codpes}', [PessoaController::class, 'show']);
Route::post('pessoas', [PessoaController::class, 'store']);
Route::get('pessoas/{codpes}/edit', [PessoaController::class, 'edit']);
Route::patch('pessoas/{codpes}', [PessoaController::class, 'update']);

#buscas
Route::get('search', [PessoaController::class, 'search']);
Route::get('search/partenome', [PessoaController::class, 'partenome'])->name('autocomplete.search');

# model User
Route::resource('users', UserController::class);
