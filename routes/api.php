<?php

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

Route::apiResource('actor', 'App\Http\Controllers\API\ActorController');

Route::apiResource('movie', 'App\Http\Controllers\API\MovieController');

Route::post('assignactor', 'App\Http\Controllers\API\ActorController@assignactor');

Route::get('actorsbymovie/{movie}', 'App\Http\Controllers\API\MovieController@actorsbymovie');

Route::get('moviesbyactor/{actor}', 'App\Http\Controllers\API\ActorController@moviesbyactor');
