<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\UserController;

Route::get('/', [PessoaController::class, 'index']);

Route::get('login', [LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

# model Pessoa
Route::get('pessoas/{codpes}', [PessoaController::class, 'show']);
Route::get('pessoas/{codpes}/edit', [PessoaController::class, 'edit']);
Route::patch('pessoas/{codpes}', [PessoaController::class, 'update']);

# model User
Route::resource('users', UserController::class);
