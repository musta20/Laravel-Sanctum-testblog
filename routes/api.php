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

Route::post('Register','UserController@Register');
Route::post('login',[ 'as' => 'login', 'uses' => 'UserController@login']);

Route::apiResource('post','PostController');

Route::apiResource('user','UserController');
