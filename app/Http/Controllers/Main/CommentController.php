<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Main
 */
class CommentController extends Controller
{
	/**
	 * @var CommentsRepositoryInterface
	 */
	private static $commentRepository;

	/**
	 * CommentController constructor.
	 *
	 * @param  CommentsRepositoryInterface  $commentsRepository
	 */
	public function __construct(CommentsRepositoryInterface $commentsRepository)
	{
		parent::__construct();
		self::$commentRepository = $commentsRepository;
	}

	public function view($idAnime)
	{
		$comments['com'] = self::getCache('animeComments_'.$idAnime, self::$commentRepository->getComments($idAnime));
		$comments['count'] = self::getCache(
			'animeCommentsCount_'.$idAnime,
			self::$commentRepository->countComments($idAnime)
		);
		return $comments;
	}

	/**
	 * @param  Request  $request
	 *
	 * @return Factory|RedirectResponse|View
	 */
	public function add(Request $request)
	{
		$comment = self::$commentRepository->setComments($request);
		if ($comment) {
			return redirect()->back();
		}
		return view(self::$theme.'/errors.error')->withErrors(['msg' => 'Ошибка добавления комментария']);
	}

	/**
	 * @param $id
	 *
	 * @return Factory|RedirectResponse|View
	 */
	public function delete($id)
	{
		$comment = self::$commentRepository->delComments($id);
		if ($comment) {
			return redirect()->back();
		}
		return view(self::$theme.'/errors.error')->withErrors(['msg' => 'Ошибка удаления комментария']);
	}
}
