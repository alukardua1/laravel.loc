<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

Route::group(
	['namespace' => 'Administrations'],
	function () {
		/** Главная страница админки */
		Route::get('', 'AdminController@index')->name('admin');
		/** Редактирование аниме */
		Route::group(
			['prefix' => 'anime'],
			function () {
				Route::get('', 'AdminAnimeController@index')->name('admin.anime.index');
				Route::get('edit/{anime}', 'AdminAnimeController@edit')->name('admin.anime.edit');
				Route::patch('edit/{anime}', 'AdminAnimeController@update')->name('admin.anime.update');
				Route::get('add', 'AdminAnimeController@create')->name('admin.anime.create');
				Route::patch('add', 'AdminAnimeController@store')->name('admin.anime.store');
				Route::get('delete/{anime}', 'AdminAnimeController@destroy')->name('admin.anime.destroy');
				Route::get('video', 'AdminAnimeController@CDNParse')->name('admin.parseCDN');
			}
		);
		/** Редактирование категорий */
		Route::group(
			['prefix' => 'category'],
			function () {
				Route::get('', 'AdminCategoryController@index')->name('admin.category');
				Route::get('edit/{category}', 'AdminCategoryController@edit')->name('admin.category.edit');
				Route::patch('edit/{category}', 'AdminCategoryController@update')->name('admin.category.update');
				Route::get('add', 'AdminCategoryController@create')->name('admin.category.add');
				Route::patch('add', 'AdminCategoryController@store')->name('admin.category.save');
				Route::get('delete/{category}', 'AdminCategoryController@delete')->name('admin.category.delete');
			}
		);
	}
);
