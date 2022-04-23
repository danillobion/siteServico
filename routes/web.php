<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LinhaController;
use App\Http\Controllers\ParadaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\LinhaEParadaController;
use App\Http\Controllers\ApiController;

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
    //paradas
    Route::get('/home/parada', [ParadaController::class, 'index'])->name('parada/index');
    Route::post('/home/parada/salvar', [ParadaController::class, 'salvarParada'])->name('parada/salvar');
    Route::post('/home/parada/editar', [ParadaController::class, 'editarParada'])->name('parada/editar');
    Route::post('/home/parada/atualizar', [ParadaController::class, 'atualizarParada'])->name('parada/atualizar');
    Route::post('/home/parada/deletar', [ParadaController::class, 'deletarParada'])->name('parada/deletar');
    //horario
    Route::get('/home/horario/{parada_id}/{dia}', [HorarioController::class, 'index'])->name('horario/index');
    Route::get('/home/horario/filtar/{parada_id}/{dia}', [HorarioController::class, 'filtarHorario'])->name('horario/filtrar');
    Route::post('/home/horario/salvar', [HorarioController::class, 'salvarHorario'])->name('horario/salvar');
    Route::post('/home/horario/editar', [HorarioController::class, 'editarHorario'])->name('horario/editar');
    Route::post('/home/horario/atualizar', [HorarioController::class, 'atualizarHorario'])->name('horario/atualizar');
    Route::post('/home/horario/deletar', [HorarioController::class, 'deletarHorario'])->name('horario/deletar');
    //linha x parada
    Route::get('/home/linha/parada/{linha_id}', [LinhaEParadaController::class, 'index'])->name('linha/parada/index');
    Route::post('/home/linha/parada/salvar', [LinhaEParadaController::class, 'salvarLinhaeParada'])->name('linha/parada/salvar');
    Route::post('/home/linha/parada/deletar', [LinhaEParadaController::class, 'deletarLinhaeParada'])->name('linha/parada/deletar');
    Route::post('/home/linha/parada/atualizar', [LinhaEParadaController::class, 'atualizarLinhaeParada'])->name('linha/parada/atualizar');
});

//API
Route::get('home/api/dados', [ApiController::class, 'transporteColetivo'])->name('api/dados');
