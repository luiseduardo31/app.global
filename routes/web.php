<?php

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


Route::resource('inventario','InventarioController');


// ROTAS ADMIN
Route::group(['middleware' => ['auth','check.permissions']], function () {
    Route::resource('filiais', 'FiliaisController');
    Route::resource('funcoes', 'FuncoesController');
    Route::resource('gestores', 'GestoresController');
    Route::resource('matriculas', 'MatriculasController');
    Route::resource('setores', 'SetoresController');
    Route::resource('subsetores', 'SubsetoresController');
    Route::resource('planos', 'PlanosController');
    Route::resource('contas', 'ContasController');
    Route::resource('empresas', 'EmpresasController');

    Route::resource('usuarios', 'UsuariosController');
    Route::resource('acessos', 'AcessosController');
   
    Route::resource('contratos-fixo', 'ContratosFixoController');
    Route::resource('contratos-movel', 'ContratosMovelController');
});

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
