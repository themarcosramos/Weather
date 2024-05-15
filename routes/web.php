<?php

use App\Http\Controllers\PrevisaoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');

Route::prefix('previsao')->group(function () {
    Route::get('/atual', [PrevisaoController::class, 'index'])->name('previsao.atual');
    Route::post('/nova', [PrevisaoController::class, 'nova'])->name('previsao.nova');
    Route::get('/listar', [PrevisaoController::class, 'previsoesSalvas'])->name('previsao.listar');
    Route::get('/ver/{id}', [PrevisaoController::class, 'previsaoSalva'])->name('previsao.salva');
    Route::get('/compare', [PrevisaoController::class, 'compararPrevisoes'])->name('previsao.compare');

    Route::prefix('/historicos')->group(function () {
        Route::get('/pesquisar', [PrevisaoController::class, 'pesquisarHistoricos'])->name('previsao.historicos.pesquisar');
        Route::get('/delete/{id}', [PrevisaoController::class, 'excluirHistorico'])->name('previsao.historicos.excluir');
    });
});
