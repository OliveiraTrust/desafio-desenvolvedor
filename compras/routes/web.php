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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/clientes', 'ControladorCliente@indexView');
Route::any('/clientes/busca', 'ControladorCliente@searchView');
Route::get('/clientes/novo', 'ControladorCliente@create');
Route::post('/clientes', 'ControladorCliente@store');
Route::get('/clientes/apagar/{id}', 'ControladorCliente@destroy');
Route::delete('/clientes/apagar', 'ControladorCliente@destroyAll');
Route::get('/clientes/editar/{id}', 'ControladorCliente@edit');
Route::post('/clientes/{id}', 'ControladorCliente@update');

Route::get('/produtos', 'ControladorProduto@indexView');
Route::any('/produtos/busca', 'ControladorProduto@searchView');
Route::get('/produtos/novo', 'ControladorProduto@create');
Route::post('/produtos', 'ControladorProduto@store');
Route::get('/produtos/apagar/{id}', 'ControladorProduto@destroy');
Route::delete('/produtos/apagar', 'ControladorProduto@destroyAll');
Route::get('/produtos/editar/{id}', 'ControladorProduto@edit');
Route::post('/produtos/{id}', 'ControladorProduto@update');

Route::get('/pedidos', 'ControladorPedido@indexView');
Route::any('/pedidos/busca', 'ControladorPedido@searchView');
Route::get('/pedidos/novo', 'ControladorPedido@create');
Route::post('/pedidos', 'ControladorPedido@store');
Route::get('/pedidos/apagar/{id}', 'ControladorPedido@destroy');
Route::delete('/pedidos/apagar', 'ControladorPedido@destroyAll');
Route::get('/pedidos/editar/{id}', 'ControladorPedido@edit');
Route::post('/pedidos/{id}', 'ControladorPedido@update');
