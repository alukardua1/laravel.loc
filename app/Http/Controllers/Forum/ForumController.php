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

    /**
     * @param $category
     */
    public function showCategory($category)
    {
        echo "This Forum {$category}!!!";
    }

    /**
     * @param $category
     * @param $post
     */
    public function showPost($category, $post)
    {
        echo "This Forum post {$category} {$post}!!!";
    }

    /**
     * @param $category
     * @param $post
     */
    public function editPost($category, $post)
    {
        echo "This Forum edit post {$category} {$post}!!!";
    }

    /**
     * @param         $category
     * @param Request $request
     */
    public function createPost($category, Request $request)
    {
        echo "This Forum create {$category} , {$request}";
    }

    /**
     * @param         $category
     * @param Request $request
     */
    public function storePost($category, Request $request)
    {
        echo "This Forum store {$category} , {$request}";
    }

    /**
     * @param         $category
     * @param         $post
     * @param Request $request
     */
    public function updatePost($category, $post, Request $request)
    {
        echo "This Forum update {$category}, {$post}, {$request}";
    }

    /**
     * @param $category
     * @param $post
     */
    public function deletePost($category, $post)
    {
        echo "This Forum delete {$category}, {$post}";
    }
}
