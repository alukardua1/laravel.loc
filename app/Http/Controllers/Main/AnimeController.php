<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use App\Traits\CreateCacheTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class AnimeController
 *
 * @package App\Http\Controllers\Main
 */
class AnimeController extends Controller
{
	use CreateCacheTrait;

	/**
	 * @var AnimeRepositoryInterface
	 */
	private static $animeRepository;
	/**
	 * @var CommentsRepositoryInterface
	 */
	private static $commentsRepository;

	/**
	 * AnimeController constructor.
	 *
	 * @param  AnimeRepositoryInterface     $animeRepository
	 * @param  CommentsRepositoryInterface  $commentsRepository
	 */
	public function __construct(
		AnimeRepositoryInterface $animeRepository,
		CommentsRepositoryInterface $commentsRepository
	) {
		parent::__construct();
		self::$animeRepository = $animeRepository;
		self::$commentsRepository = $commentsRepository;
	}

	/**
	 * Главная страница аниме
	 *
	 * @return Renderable
	 */
	public function index(): Renderable
	{
		$animePost = self::$animeRepository->getAnime()->paginate(self::$paginate);

		return view(self::$theme.'/home', compact('animePost'));
	}

	/**
	 * Страница аниме поста
	 *
	 * @param $urlAnime
	 *
	 * @return Factory|RedirectResponse|Redirector|View|void
	 */
	public function view($urlAnime)
	{
		$uri = explode('-', $urlAnime);
		$stringUrl = preg_split("/[0-9]+-/", $urlAnime);
		$animePost = self::getCache('anime_'.$uri[0], self::$animeRepository->getAnime($uri[0])->first());
		$comments = self::getCache('animeComments_'.$uri[0], self::$commentsRepository->getComments($uri[0]));
		$commentsCount = self::getCache(
			'animeCommentsCount_'.$uri[0],
			self::$commentsRepository->countComments($uri[0])
		);
		$animePost = self::currentRefactoring($animePost);

		if (empty($animePost)) {
			return abort(404);
		}

		if ($stringUrl[1] != $animePost->url) {
			return redirect('/anime/'.$animePost->id.'-'.$animePost->url);
		}

		return view(self::$theme.'/full_anime', compact('animePost', 'comments', 'commentsCount'));
	}

	/**
	 * Поиск по сайту
	 *
	 * @param  Request  $request
	 *
	 * @return Factory|View
	 */
	public function search(Request $request)
	{
		$animePost = self::$animeRepository->getSearch($request)->paginate(self::$paginate);

		if (empty($animePost)) {
			return view(self::$theme.'/errors.error')->withErrors(['msg' => 'Ничего не найдено']);
		}

		return view(self::$theme.'/home', compact('animePost'));
	}
}
