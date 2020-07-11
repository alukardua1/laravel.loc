<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

Route::group(['namespace' => 'Forum'],
	function (){
		Route::get('', 'ForumController@index')->name('forum.index');
		Route::get('{category}', 'ForumController@showCategory')->name('forum.category');
		Route::get('{category}/{post}', 'ForumController@showPost')->name('forum.post');
		Route::post('{category}/add/{post}', 'ForumController@storePost')->name('forum.post.add');
		Route::get('{category}/edit/{post}', 'ForumController@editPost')->name('forum.post.edit');
		Route::post('{category}/update/{post}', 'ForumController@updatePost')->name('forum.post.edit');
		Route::get('{category}/delete/{post}', 'ForumController@deletePost')->name('forum.post.delete');
	}
);
