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

Auth::routes();
Route::group(
    ['namespace' => 'Main'],
    function () {
        /** Главная страница */
        Route::get('', 'AnimeController@index')->name('home');
        Route::group(
            ['prefix' => 'anime'],
            function () {
                /** Страница аниме */
                Route::get('{anime}', 'AnimeController@view')->name('anime');
            }
        );
        Route::group(
            ['prefix' => 'search'],
            function () {
                /** Страница поиска */
                Route::get('', 'AnimeController@search')->name('search');
            }
        );
        Route::group(
            ['prefix' => 'user'],
            function () {
                /** Страница пользователя */
                Route::get('{user}', 'UserController@view')->name('profile')->middleware('auth');
                Route::patch('{user}', 'UserController@update')->name('editProfile')->middleware('auth');
            }
        );
        Route::group(
            ['prefix' => 'category'],
            function () {
                /** Страница категорий */
                Route::get('{category}', 'CategoryController@view')->name('category');
            }
        );
        Route::group(
            ['prefix' => 'page'],
            function () {
                /** Статическая страница */
                Route::get('{page}', 'StaticPageController@view')->name('page');
            }
        );
        /** Избранное */
        Route::post('/favorite/{id}', 'FavoriteController@favorite')->name('favorite_add');
        Route::post('/unfavorite/{id}', 'FavoriteController@unFavorite')->name('favorite_del');
        /** Голосование на сайте */
        Route::post('/plusVotes/{id}', 'VoteController@plusVotes')->name('votes_plus');
        Route::post('/minusVotes/{id}', 'VoteController@minusVotes')->name('votes_minus');
        /** Выборки по полям */
        Route::get('custom/{custom}/{variable}', 'CustomController@loadCustom')->name('custom');
    }
);

Route::group(
    ['namespace' => 'Administrations', 'prefix' => 'administrations/administrator'],
    function () {
        /** Главная страница админки */
        Route::get('', 'AdminController@index')->name('admin');
        /** Редактирование аниме */
        Route::group(
            ['prefix' => 'anime'],
            function () {
                Route::get('', 'AdminAnimeController@index')->name('admin.anime');
                Route::get('edit/{anime}', 'AdminAnimeController@edit')->name('admin.anime.edit');
                Route::patch('edit/{anime}', 'AdminAnimeController@update')->name('admin.anime.update');
                Route::get('add', 'AdminAnimeController@create')->name('admin.anime.add');
                Route::patch('add', 'AdminAnimeController@store')->name('admin.anime.save');
                Route::get('delete/{anime}', 'AdminAnimeController@delete')->name('admin.anime.delete');
            }
        );
        /** Редактирование категорий */
        Route::group(
            ['prefix' => 'category'],
            function () {
                Route::get('', 'AdminCategoryController@index')->name('admin.category');
                Route::get('edit/{category}', 'AdminCategoryController@edit')->name('admin.category.edit');
                Route::patch('edit/{category}', 'AdminCategoryController@edit')->name('admin.category.update');
                Route::get('add', 'AdminCategoryController@create')->name('admin.category.add');
                Route::patch('add', 'AdminCategoryController@store')->name('admin.category.save');
                Route::get('delete/{category}', 'AdminCategoryController@delete')->name('admin.category.delete');
            }
        );
    }
);
//Route::get('/home', 'HomeController@index')->name('home');
