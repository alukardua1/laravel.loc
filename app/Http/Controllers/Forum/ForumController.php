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
	public function indexForum()
    {
    	echo 'This Forum!!!';
    }

    public function CategoryForum($category)
    {

    }

    public function viewPostForum($id)
    {

    }
}
