<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use Cache;
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
	private static $keyCache      = 'animeComments_';
	private static $keyCacheCount = 'animeCommentsCount_';

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

	/**
	 * @param  int  $idAnime
	 *
	 * @return mixed
	 */
	public function view($idAnime)
	{
		if (Cache::has(self::$keyCache . $idAnime)) {
			$comments['com'] = Cache::get(self::$keyCache . $idAnime);
		} else {
			$comments['com'] = self::setCache(self::$keyCache . $idAnime, self::$commentRepository->getComments($idAnime));
		}
		if (Cache::has(self::$keyCache . $idAnime)) {
			$comments['count'] = Cache::get(self::$keyCacheCount . $idAnime);
		} else {
			$comments['count'] = self::setCache(self::$keyCacheCount . $idAnime, self::$commentRepository->countComments($idAnime));
		}

		return $comments;
	}

	/**
	 * @param  Request  $request
	 *
	 * @return Factory|RedirectResponse|View
	 */
	public function addComment(Request $request)
	{
		$comment = self::$commentRepository->setComments($request);
		if ($comment) {
			return redirect()->back();
		}
		return view(self::$theme . '/errors.error')->withErrors(['msg' => 'Ошибка добавления комментария']);
	}

	/**
	 * @param $id
	 *
	 * @return Factory|RedirectResponse|View
	 */
	public function deleteComment($id)
	{
		$comment = self::$commentRepository->delComments($id);
		if ($comment) {
			return redirect()->back();
		}
		return view(self::$theme . '/errors.error')->withErrors(['msg' => 'Ошибка удаления комментария']);
	}
}
