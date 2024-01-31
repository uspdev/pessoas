<?php

use App\Http\Controllers\PessoaController;
use App\Http\Controllers\PosgradController;

Route::get('/', [PessoaController::class, 'index']);

# model Pessoa
Route::get('pessoas/{codpes}', [PessoaController::class, 'show'])->name('pessoas.show');
Route::get('pessoas/{codpes}/edit', [PessoaController::class, 'edit'])->name('pessoas.edit');
Route::patch('pessoas/{codpes}', [PessoaController::class, 'update'])->name('pessoas.update');

# Pós graduação
Route::get('posgrad', [PosgradController::class, 'index']);
Route::post('posgrad', [PosgradController::class, 'index']);

Route::get('posgrad/{codcur}', [PosgradController::class, 'show']);
