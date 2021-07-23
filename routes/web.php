<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\PosgradController;
use App\Http\Controllers\UserController;

Route::get('/', [PessoaController::class, 'index']);

# model Pessoa
Route::get('pessoas/{codpes}', [PessoaController::class, 'show']);
Route::get('pessoas/{codpes}/edit', [PessoaController::class, 'edit']);
Route::patch('pessoas/{codpes}', [PessoaController::class, 'update']);

# Pós graduação
Route::get('posgrad', [PosgradController::class, 'index']);
Route::post('posgrad', [PosgradController::class, 'index']);

# Logs  
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');
