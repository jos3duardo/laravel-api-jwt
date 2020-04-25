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

Route::post('login', 'Api\AuthController@login');

Route::post('refresh','Api\AuthController@refresh');

//token is necessary for access this route
Route::middleware(['auth:api','jwt.refresh'])->namespace('Api')->group(function () {
    Route::get('users', 'AuthController@users');
    Route::post('logout','AuthController@logout');
});
