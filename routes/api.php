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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'v1', 'namespace' => 'API', 'middleware' => ['cors']], function () {
    // User
    Route::get('/users', 'UserController@index');
    Route::get('/user', 'UserController@showUsername');
    Route::delete('/user/{id}', 'UserController@destroy');
    Route::get('/user/{id}', 'UserController@show');
    Route::post('/user', 'UserController@store');
    Route::put('/user/{id}', 'UserController@update');

    // Todos
    Route::get('/todos','TodoController@index');
    Route::get('/todos/{id}','TodoController@showTodo');
    Route::post('/todo', 'TodoController@store');
    Route::get('/todo/{user_id}', 'TodoController@show');
    Route::put('/todo/{id}','TodoController@update');
    Route::delete('/todo/{id}', 'TodoController@destroy');
});