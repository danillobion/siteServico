<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmpresaController;

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
});
