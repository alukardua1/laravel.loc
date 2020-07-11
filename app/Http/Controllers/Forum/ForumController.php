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
	    echo "This Forum {$category} {$post}!!!";
    }

	public function editPost($post)
	{
		echo "This Forum {$post}!!!";
	}

    public function storePost($category, Request $request)
    {
    	echo "{$category} , {$request}";
    }

	public function updatePost($category, $post, Request $request)
	{
		echo "{$category}, {$post}, {$request}";
	}

	public function deletePost($category, $post)
	{
		echo "{$category}, {$post}";
	}
}
