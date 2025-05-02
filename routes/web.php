<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserConfigController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
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
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::resource('fornecedores', FornecedorController::class)->middleware('auth');
Route::resource('produtos', ProdutoController::class)->middleware('auth');


Route::resource('empresas', EmpresaController::class)->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/empresa/criar', [App\Http\Controllers\EmpresaController::class, 'criar'])->name('empresa.criar');
    Route::post('/empresa/salvar', [App\Http\Controllers\EmpresaController::class, 'salvar'])->name('empresa.salvar');

    Route::middleware('verifica.empresa')->group(function () {
        // rotas do ERP protegidas por empresa definida
        Route::resource('produtos', ProdutoController::class);
        Route::get('/funcionarios', [App\Http\Controllers\EmpresaController::class, 'funcionarios'])->name('empresa.funcionarios');
        Route::post('/funcionarios/adicionar', [App\Http\Controllers\EmpresaController::class, 'adicionarFuncionario'])->name('empresa.funcionarios.adicionar');
        Route::middleware(['auth'])->group(function () {
            Route::get('/empresa/criar', [EmpresaController::class, 'criar'])->name('empresa.criar');
            Route::post('/empresa/salvar', [EmpresaController::class, 'salvar'])->name('empresa.salvar');
        
            Route::middleware('verifica.empresa')->group(function () {
                Route::resource('produtos', ProdutoController::class);
                Route::resource('fornecedores', FornecedorController::class); // <-- ADICIONE AQUI
                Route::get('/funcionarios', [EmpresaController::class, 'funcionarios'])->name('empresa.funcionarios');
                Route::post('/funcionarios/adicionar', [EmpresaController::class, 'adicionarFuncionario'])->name('empresa.funcionarios.adicionar');
            });
        });
        
    });
});

Route::get('/configuracoes', [EmpresaController::class, 'configuracoes'])->name('empresa.configuracoes');
Route::post('/configuracoes/atualizar-dados', [EmpresaController::class, 'atualizarDados'])->name('empresa.atualizarDados');
Route::post('/configuracoes/adicionar-email', [EmpresaController::class, 'adicionarEmail'])->name('empresa.adicionarEmail');
Route::delete('/configuracoes/remover-email/{id}', [EmpresaController::class, 'removerEmail'])->name('empresa.removerEmail');
Route::delete('/configuracoes/remover-funcionario/{id}', [EmpresaController::class, 'removerFuncionario'])->name('empresa.removerFuncionario');
Route::post('/configuracoes/atualizar-senha/{id}', [EmpresaController::class, 'atualizarSenhaFuncionario'])->name('empresa.atualizarSenha');
Route::post('/configuracoes/alterar-senha', [UserController::class, 'alterarSenha'])->name('user.alterarSenha');
Route::middleware(['auth'])->group(function () {
    Route::get('/configuracao/usuario', [UserConfigController::class, 'index'])->name('config.usuario');
    Route::post('/configuracao/usuario/email', [UserConfigController::class, 'atualizarEmail'])->name('config.usuario.email');
    Route::post('/configuracao/usuario/senha', [UserConfigController::class, 'atualizarSenha'])->name('config.usuario.senha');
});



