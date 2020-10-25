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

Route::get('/colors', 'API\ColorsController@index');
Route::post('/colors', 'API\ColorsController@store');
Route::put('/colors/{id}', 'API\ColorsController@update');
Route::delete('/colors/{id}', 'API\ColorsController@destroy');

