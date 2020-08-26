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

Route::get('houseplants', 'HouseplantController@index');
Route::post('houseplants', 'HouseplantController@store');
Route::get('houseplants/{id}', 'HouseplantController@show');
Route::delete('houseplants/{id}', 'HouseplantController@destroy');
