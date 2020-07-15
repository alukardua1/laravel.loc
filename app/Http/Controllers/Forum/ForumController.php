<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;

/**
 * Class ForumController
 *
 * @package App\Http\Controllers\Forum
 */
class ForumController extends BaseForumController
{
	/**
	 *
	 */
	public function index()
    {
    	echo 'This Forum!!!';
    }

    public function showCategory($category)
    {
	    echo "This Forum {$category}!!!";
    }

    public function showPost($category, $post)
    {
	    echo "This Forum post {$category} {$post}!!!";
    }

	public function editPost($category, $post)
	{
		echo "This Forum edit post {$category} {$post}!!!";
	}

	public function createPost($category, Request $request)
	{
		echo "This Forum create {$category} , {$request}";
	}

    public function storePost($category, Request $request)
    {
    	echo "This Forum store {$category} , {$request}";
    }

	public function updatePost($category, $post, Request $request)
	{
		echo "This Forum update {$category}, {$post}, {$request}";
	}

	public function deletePost($category, $post)
	{
		echo "This Forum delete {$category}, {$post}";
	}
}
