<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LinhaController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//aberto
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//acesso restrito a usuarios logados
Route::group(['middleware' => 'type'], function () {
    //empresa
    Route::get('/home/empresa', [EmpresaController::class, 'index'])->name('empresa/index');
    Route::post('/home/empresa/salvar', [EmpresaController::class, 'salvarEmpresa'])->name('empresa/salvar');
    Route::post('/home/empresa/atualizar', [EmpresaController::class, 'atualizarEmpresa'])->name('empresa/atualizar');
    Route::post('/home/empresa/deletar', [EmpresaController::class, 'deletarEmpresa'])->name('empresa/deletar');
    //linha
    Route::get('/home/linha/{empresa_id}', [LinhaController::class, 'index'])->name('linha/index');
    Route::post('/home/linha/salvar', [LinhaController::class, 'salvarLinha'])->name('linha/salvar');
    Route::post('/home/linha/editar', [LinhaController::class, 'editarLinha'])->name('linha/editar');
    Route::post('/home/linha/atualizar', [LinhaController::class, 'atualizarLinha'])->name('linha/atualizar');
    Route::post('/home/linha/deletar', [LinhaController::class, 'deletarLinha'])->name('linha/deletar');
});
