<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

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

Auth::routes();
Route::group(
    ['namespace' => 'Main'],
    function () {
        /** Главная страница */
        Route::get('', 'AnimeController@index')->name('home');
        /** Страница аниме */
        Route::group(
            ['prefix' => 'anime'],
            function () {
                Route::get('{id}-{slug?}', 'AnimeController@show')->name('anime')->where('id', '[0-9]+');
            }
        );
        /** Страница поиска */
        Route::group(
            ['prefix' => 'search'],
            function () {
                Route::get('', 'AnimeController@search')->name('search');
            }
        );
        /** Страница пользователя */
        Route::group(
            ['prefix' => 'user'],
            function () {
                Route::get('{user}', 'UserController@show')->name('profile')->middleware('auth');
                Route::patch('{user}', 'UserController@update')->name('editProfile')->middleware('auth');
            }
        );
        /** Страница категорий */
        Route::group(
            ['prefix' => 'category'],
            function () {
                Route::get('{category}', 'CategoryController@show')->name('category');
            }
        );
        /** Статическая страница */
        Route::group(
            ['prefix' => 'page'],
            function () {
                Route::get('{page}', 'StaticPageController@show')->name('page');
            }
        );
        /** Избранное */
        Route::post('/favorites_add/{id}', 'FavoriteController@add')->name('favorite_add')->middleware('auth');
        Route::post('/favorites_del/{id}', 'FavoriteController@delete')->name('favorite_del')->middleware('auth');
        /** Голосование на сайте */
        Route::post('/plus/{id}', 'VoteController@plus')->name('votes_plus')->middleware('auth');
        Route::post('/minus/{id}', 'VoteController@minus')->name('votes_minus')->middleware('auth');
        /** Выборки по полям */
        Route::group(
            ['prefix' => 'custom'],
            function () {
                Route::get('{custom}/{variable}', 'CustomController@show')->name('custom');
            }
        );
        /** Люди */
        Route::group(
            ['prefix' => 'people'],
            function () {
                Route::get('', 'PeopleController@index')->name('peoples');
                Route::get('{id}-{people}', 'PeopleController@show')->name('people')->where('id', '[0-9]+');
            }
        );
        /** Персонажи */
        Route::group(
            ['prefix' => 'character'],
            function () {
                Route::get('', 'CharacterController@index')->name('characters');
                Route::get('{id}-{character}', 'CharacterController@show')->name('character')->where('id', '[0-9]+');
            }
        );
        /** Комментарии */
        Route::group(
            ['prefix' => 'comments'],
            function () {
                Route::post('add', 'CommentController@store')->name('addComment')->middleware('auth');
                Route::get('delete/{comment}', 'CommentController@delete')->name('deleteComment')->middleware('auth');
            }
        );

        Route::group(
            ['prefix' => 'translate'],
            function () {
                Route::get('{id}-{translate}', 'TranslateController@show')->name('translate')->where('id', '[0-9]+');
            }
        );
    }
);


//Route::get('/home', 'HomeController@index')->name('home');
