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
	Route::group(['prefix'=>'category'], function ()
	{
		Route::get('', 'GenreApiController@index');
		Route::get('{url}', 'GenreApiController@view');
	});
	Route::group(['prefix'=>'anime'], function ()
	{
		Route::get('{id}', 'AnimeApiController@view');
		Route::get('', 'AnimeApiController@index');
	});
}

);