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

Route::group(['as' => 'api.'], function () {
    Route::apiResource('items', 'ItemController');
    Route::post('items/{id}/restore', 'ItemController@restore');
    Route::delete('items/{id}/force/delete', 'ItemController@forceDelete');
});