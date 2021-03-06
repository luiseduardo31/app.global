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



Route::get('/inventario/{id?}', 'InventarioController@index')->name('inventario.index');
Route::get('/inventario/{id}/edit', 'InventarioController@edit')->name('inventario.edit');
Route::delete('/inventario/{id}', 'InventarioController@destroy')->name('inventario.destroy');
*/
#Route::resource('minha-linha', 'InvMovelUserController');
Route::get('/minha-linha', 'InvMovelUserController@index')->name('minha-linha.index');
Route::get('/minha-linha/{id}/line', 'InvMovelUserController@edit')->name('minha-linha.edit');
Route::put('/minha-linha/{id}', 'InvMovelUserController@update')->name('minha-linha.update');


Route::resource('meus-dados', 'MeusDadosController')->middleware(['auth','check.session.group']);
Route::resource('inventario', 'InventarioController')->middleware(['auth','check.session.group']);
Route::resource('escolher-grupo', 'EscolherGrupoController');

Route::resource('contratos-fixo', 'ContratosFixoController')->middleware(['auth', 'check.session.group']);
Route::resource('contratos-movel', 'ContratosMovelController')->middleware(['auth', 'check.session.group']);
Route::resource('contratos-dados', 'ContratosDadosController')->middleware(['auth', 'check.session.group']);

Route::resource('contratos', 'ContratosController');

// ROTAS ADMIN
Route::group(['middleware' => ['auth','check.permissions','check.session.group']], function () {

    
    

    Route::resource('filiais', 'FiliaisController');
    Route::resource('funcoes', 'FuncoesController');
    Route::resource('gestores', 'GestoresController');
    Route::resource('matriculas', 'MatriculasController');
    Route::resource('setores', 'SetoresController');
    Route::resource('subsetores', 'SubsetoresController');
    Route::resource('planos', 'PlanosController');
    Route::resource('contas', 'ContasController');
    Route::resource('empresas', 'EmpresasController');
    Route::resource('grupos', 'GruposController');

    Route::resource('usuarios', 'UsuariosController');
    Route::resource('acessos', 'AcessosController');
    Route::resource('logs', 'LogsController');
    Route::resource('logs-acessos', 'LogsLoginsController');
   

});

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
