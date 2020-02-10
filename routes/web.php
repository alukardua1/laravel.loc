<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

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
    /** Главная страница */
    Route::get('', 'AnimeController@index')->name('home');
    /** Страница аниме */
    Route::get('anime/{anime}', 'AnimeController@view')->name('anime');
    /** Страница поиска */
    Route::get('search', 'AnimeController@search')->name('search');
    /** Выборки по полям */
    Route::get('tip/{tip}', 'CustomController@tip')->name('tip');
    Route::get('year/{year}', 'CustomController@year')->name('year');
    /** Страница пользователя */
    Route::get('user/{user}', 'UserController@view')->name('profile')->middleware('auth');
    Route::patch('user/{user}', 'UserController@update')->name('editProfile')->middleware('auth');
    /** Страница категорий */
    Route::get('category/{category}', 'CategoryController@view')->name('category');
    /** Статическая страница */
    Route::get('page/{page}', 'StaticPageController@view')->name('page');
});

Route::group(['namespace' => 'Administrations'], function () {
    Route::get('administrations/administrator', 'AdminController@index')->name('admin');
    Route::get('administrations/administrator/anime', 'AdminAnimeController@index')->name('admin.anime');
    Route::get('administrations/administrator/anime/edit/{anime}', 'AdminAnimeController@edit')->name('admin.anime.edit');
    Route::patch('administrations/administrator/anime/edit/{anime}', 'AdminAnimeController@update')->name('admin.anime.update');
    Route::get('administrations/administrator/anime/add', 'AdminAnimeController@create')->name('admin.anime.add');
    Route::patch('administrations/administrator/anime/add', 'AdminAnimeController@store')->name('admin.anime.save');
    Route::get('administrations/administrator/anime/delete/{anime}', 'AdminAnimeController@delete')->name('admin.anime.delete');

    Route::get('administrations/administrator/category', 'AdminCategoryController@index')->name('admin.category');
});
//Route::get('/home', 'HomeController@index')->name('home');
