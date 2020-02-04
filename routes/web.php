<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
Route::group(['namespace' => 'Main'], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('search', 'HomeController@search')->name('search');
    Route::get('kind/{kind}', 'HomeController@custom')->name('kind');
    Route::get('anime/{anime}', 'HomeController@anime')->name('anime');
    Route::get('user/{user}', 'UserController@profile')->name('profile')->middleware('auth');
    Route::patch('user/{user}', 'UserController@editProfile')->name('editProfile')->middleware('auth');
    Route::get('category/{category}', 'HomeController@getCategory')->name('category');
});
Route::group(['namespace' => 'Admin'], function () {
    Route::get('/administrator', 'AdminController@index')->name('admin');
});
//Route::get('/home', 'HomeController@index')->name('home');
