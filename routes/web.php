<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ManutencoesController;
use App\Http\Controllers\OrdemProducaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::patch('/setores/{id}/status',[SetorController::class,'ativarDesativar'])->name('setores.ativar-desativar');
    Route::patch('/equipamentos/{id}/status',[EquipamentoController::class,'ativarDesativar'])->name('equipamentos.ativar-desativar');
    Route::patch('/manutencoes/{id}/status',[ManutencoesController::class,'alterarStatus'])->name('manutencoes.alterar-status');
    Route::patch('/ordens_producao/{id}/status',[OrdemProducaoController::class,'alterarStatus'])->name('ordens_producao.alterar-status');


    Route::resource('chamados', ChamadoController::class);
    Route::resource ('setores', SetorController::class);
    Route::resource ('funcionarios', FuncionarioController::class);
    Route::resource ('equipamentos', EquipamentoController::class);
    Route::resource ('manutencoes', ManutencoesController::class);
     Route::resource ('ordens_producao', OrdemProducaoController::class);
});
require __DIR__.'/auth.php';
 