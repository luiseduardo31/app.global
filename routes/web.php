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
Route::resource('funcoes','FuncoesController');
Route::resource('gestores','GestoresController');
Route::resource('matriculas', 'MatriculasController');
Route::resource('setores', 'SetoresController');
Route::resource('subsetores', 'SubsetoresController');
Route::resource('planos', 'PlanosController');
Route::resource('contas', 'ContasController');
Route::resource('filiais', 'FiliaisController');

// admin
Route::get('/usuarios', 'UsuariosController@index');
Route::resource('acessos', 'AcessosController@edit');
Route::resource('contratos-fixo', 'ContratosFixoController');
Route::resource('contratos-movel', 'ContratosMovelController');



Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
