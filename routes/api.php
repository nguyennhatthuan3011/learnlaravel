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
    Route::get('/user/{id}', 'UserController@show');
    Route::post('/user', 'UserController@store');
    Route::put('/user/{id}', 'UserController@update');
});

Route::group(['prefix' => 'v2', 'namespace' => 'API'], function (){
    // Todos
    Route::get('/todos','TodoController@index');
    Route::post('/todo', 'TodoController@store');
    Route::get('/todo/{id}', 'TodoController@show');
    Route::put('/todo/{id}', 'TodoController@update');
    Route::delete('/todo/{id}', 'TodoController@destroy');
});
