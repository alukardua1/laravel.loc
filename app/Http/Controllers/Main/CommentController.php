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
    /**
     * @var \App\Repositories\Interfaces\CommentsRepositoryInterface
     */
    private static $commentRepository;

    /**
     * CommentController constructor.
     *
     * @param  \App\Repositories\Interfaces\CommentsRepositoryInterface  $commentsRepository
     */
    public function __construct(CommentsRepositoryInterface $commentsRepository)
    {
        parent::__construct();
        self::$commentRepository = $commentsRepository;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function addComments(Request $request)
    {
        $comment = self::$commentRepository->setComments($request);
        if ($comment)
        {
            return redirect()->back();
        }
        return view(self::$theme.'/errors.error')->withErrors(['msg' => 'Ошибка добавления комментария']);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function deleteComment($id)
    {
        $comment = self::$commentRepository->delComments($id);
        if ($comment)
        {
            return redirect()->back();
        }
        return view(self::$theme.'/errors.error')->withErrors(['msg' => 'Ошибка удаления комментария']);
    }
}
