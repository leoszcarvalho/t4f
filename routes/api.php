<?php

use Illuminate\Http\Request;

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


Route::get('eventos', 'EventController@index');
Route::post('eventos', 'EventController@store');

Route::post('busca', 'EventController@search');


Route::get('ingressos', 'TicketController@index');
Route::post('ingressos', 'TicketController@store');

Route::get('validar/{code}', 'TicketController@valid');


Route::get('clientes', 'ClientController@index');
Route::post('clientes', 'ClientController@store');


Route::get('carrinho/{token}', 'CartController@show');
Route::post('carrinho', 'CartController@store');


Route::post('checkout', 'CheckoutController@store');


