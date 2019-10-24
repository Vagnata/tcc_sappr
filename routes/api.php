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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix'    => 'produto',
], function () {
    Route::delete('/{id}', 'ProductController@delete');
});

Route::group([
    'prefix'    => 'pedido',
], function () {
    Route::put('/cancelar/{id}', 'OrderController@cancelOrder');
    Route::put('/confirmar/{id}', 'OrderController@confirmOrder');
    Route::put('/finalizar/{id}', 'OrderController@finalizeOrder');
});
