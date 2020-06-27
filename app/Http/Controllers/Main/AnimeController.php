<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Traits\CreateCacheTrait;
use Cache;
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
	 * @var string $keyCache ключ для создания кэша
	 */
	private static $keyCache = 'anime_';

	/**
	 * AnimeController constructor.
	 *
	 * @param  AnimeRepositoryInterface  $animeRepository  репозиторий постов аниме
	 */
	public function __construct(AnimeRepositoryInterface $animeRepository)
	{
		parent::__construct();
		self::$animeRepository = $animeRepository;
	}

	/**
	 * Главная страница аниме
	 *
	 * @var \App\Models\Anime $animePost
	 * @return Renderable
	 */
	public function index(): Renderable
	{
		$animePost = self::$animeRepository->getAnime()->paginate(self::$paginate);

		return view(self::$theme . '/home', compact('animePost'));
	}

	/**
	 * Страница аниме поста
	 *
	 * @param  string         $urlAnime  Урл страницы поста
	 *
	 * @var \App\Models\Anime $animePost масив новости из базы
	 * @return Factory|RedirectResponse|Redirector|View|void
	 */
	public function view($urlAnime)
	{
		/** @var mixed $uri масив урл после разбивки */
		$uri = self::parseUrl($urlAnime);
		/** @var string $idAnime ID из урл */
		$idAnime = $uri['uri'][0];
		/** @var string $slugAnime Slug из урл */
		$slugAnime = $uri['stringUrl'][1];

		if (Cache::has(self::$keyCache . $idAnime)) {
			$animePost = Cache::get(self::$keyCache . $idAnime);
		} else {
			$animePost = self::setCache(self::$keyCache . $idAnime, self::$animeRepository->getAnime($idAnime)->first());
		}

		$comm = app(CommentController::class)->view($idAnime);

		$animePost = self::currentRefactoring($animePost);

		if (empty($animePost)) {
			return abort(404);
		}

		if ($slugAnime !== $animePost->url) {
			return redirect('/anime/' . $animePost->id . '-' . $animePost->url);
		}

		return view(self::$theme . '/full_anime', compact('animePost', 'comm'));
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
			return view(self::$theme . '/errors.error')->withErrors(['msg' => 'Ничего не найдено']);
		}

		return view(self::$theme . '/home', compact('animePost'));
	}
}
