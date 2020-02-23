<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Main
 */
class CommentController extends Controller
{
    private static $commentRepository;

    public function __construct(CommentsRepositoryInterface $commentsRepository)
    {
        parent::__construct();
        self::$commentRepository = $commentsRepository;
    }

    public function addComments(Request $request)
    {
        $comment = self::$commentRepository->setComments($request);
        if ($comment)
        {
            return redirect()->back();
        }
        return view(self::$theme.'/errors.error')->withErrors(['msg' => 'Ошибка добавления комментария']);
    }
}
