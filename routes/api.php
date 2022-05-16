<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// USUARIOS
// signup
Route::post('/signup', 'APIController@store_users');
// rota para logar
Route::post('/login', 'AuthController@login');

// Route::group(['middleware' => ['jwt.auth']], function () {

    // CLIENTES
    // cadastro clientes
    Route::post('/storeClientes', 'APIController@store_clientes');
    // atualizar clientes
    Route::put('/updateClientes/{id}', 'APIController@update_clientes');
    // listar clientes
    Route::get('/indexClientes', 'APIController@index_clientes');
    // mostrar clientes
    Route::put('/showClientes/{id}', 'APIController@show_clientes');
    // deletar clientes
    Route::delete('/destroyClientes/{id}', 'APIController@destroy_clientes');
    
    
    // PRODUTOS
    // cadastro produtos
    Route::post('/storeProdutos', 'APIController@store_produtos');
    // atualizar produtos
    Route::put('/updateProdutos/{id}', 'APIController@update_produtos');
    // listar produtos
    Route::get('/indexProdutos', 'APIController@index_produtos');
    // mostrar um produto
    Route::get('/showProdutos/{id}', 'APIController@show_produtos');
    // deletar produtos
    Route::delete('/deleteProdutos/{id}', 'APIController@delete_produtos');
    
    // VENDAS
    // cadastro vendas
    Route::post('/storeVendas', 'APIController@store_vendas');
// });
