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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'v1', 'namespace' => 'API'], function () {
    // User
    Route::get('/users', 'UserController@index');
    Route::delete('/user/{id}', 'UserController@destroy');
    Route::post('/user', 'UserController@store');
    Route::put('/user/{id}', 'UserController@update');
});


// Todos

//Route::get('/todos','TodoController@index');