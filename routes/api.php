<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(
	['namespace' => 'Api', 'prefix'=>'v1'], function ()
{
	Route::get('category', 'GenreApiController@index');
	Route::get('category/{url}', 'GenreApiController@view');
	Route::get('anime/{id}', 'AnimeApiController@view');
	Route::get('anime', 'AnimeApiController@index');
}

);