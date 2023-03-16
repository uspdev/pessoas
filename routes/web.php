<?php

use App\Http\Controllers\PessoaController;
use App\Http\Controllers\PosgradController;
use App\Http\Controllers\GraduacaoController;

Route::get('/', [PessoaController::class, 'index']);

# model Pessoa
Route::get('pessoas/{codpes}', [PessoaController::class, 'show']);
Route::get('pessoas/{codpes}/edit', [PessoaController::class, 'edit']);
Route::patch('pessoas/{codpes}', [PessoaController::class, 'update']);

# Pós graduação
Route::get('posgrad', [PosgradController::class, 'index']);
Route::post('posgrad', [PosgradController::class, 'index']);

Route::get('posgrad/{codcur}', [PosgradController::class, 'show']);

# Graduação
Route::get('graduacao/relatorio/nomes', [GraduacaoController::class, 'relatorioPorNomes'])->name('graduacao.relatorio.porNomes');
Route::post('graduacao/relatorio/nomes', [GraduacaoController::class, 'relatorioPorNomes'])->name('graduacao.relatorio.porNomes.post');

Route::get('graduacao/relatorios', [GraduacaoController::class, 'relatorio']);
