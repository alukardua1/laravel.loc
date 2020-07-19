<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use App\Models\Anime;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\TranslateRepositoryInterface;
use App\Repositories\ParseVideoCDNRepository;
use App\Traits\FunctionsTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Lang;

/**
 * Class AdminAnimeController
 *
 * @package App\Http\Controllers\Administrations
 */
class AdminAnimeController extends AdminBaseController
{
    use FunctionsTrait;

    /**
     * @var CategoryRepositoryInterface
     */
    private static $categoryRepository;

    /**
     * @var AnimeRepositoryInterface
     */
    private static $animeRepository;

    /**
     * @var CountryRepositoryInterface
     */
    private static $countryRepository;

    /**
     * @var TranslateRepositoryInterface
     */
    private static $translateRepository;

    /**
     * @var ParseVideoCDNRepository
     */
    private static $CDNVideo;

    /**
     * AdminAnimeController constructor.
     *
     * @param AnimeRepositoryInterface     $animeRepository
     * @param CategoryRepositoryInterface  $categoryRepository
     * @param CountryRepositoryInterface   $countryRepository
     * @param TranslateRepositoryInterface $translateRepository
     * @param ParseVideoCDNRepository      $parseVideoCDNRepository
     */
    public function __construct(
        AnimeRepositoryInterface $animeRepository,
        CategoryRepositoryInterface $categoryRepository,
        CountryRepositoryInterface $countryRepository,
        TranslateRepositoryInterface $translateRepository,
        ParseVideoCDNRepository $parseVideoCDNRepository
    ) {
        parent::__construct();
        self::$categoryRepository = $categoryRepository;
        self::$animeRepository = $animeRepository;
        self::$countryRepository = $countryRepository;
        self::$translateRepository = $translateRepository;
        self::$CDNVideo = $parseVideoCDNRepository;
    }

    /**
     * Главная страница всех записей аниме
     *
     * @return Factory|View
     * @uses AdminBaseController::$paginate
     * @var Anime $animePost
     */
    public function index()
    {
        $animePost = self::$animeRepository->getAnime(null, true)->paginate(self::$paginate);

        return view('admin.anime.index', compact('animePost'));
    }

    /**
     * Страница редактирования аниме
     *
     * @param string $animeUrl
     *
     * @return Factory|View
     * @var Anime    $animePost
     *
     */
    public function edit($animeUrl)
    {
        $setAnime = self::setAnimeAdmin();

        $animePost = self::$animeRepository->getAnime($animeUrl)->first();

        return view('admin.anime.edit', compact('animePost', 'setAnime'));
    }

    /**
     * Дополнительные поля для админки
     *
     * @return mixed
     */
    public static function setAnimeAdmin()
    {
        $setAnime['category'] = self::$categoryRepository->getCategory()->get();
        $setAnime['country'] = self::$countryRepository->getCountry(['id', 'title']);
        $setAnime['translate'] = self::$translateRepository->getTranslate();
        $setAnime['tip'] = Lang::get('attributes.minTip');
        $setAnime['rating'] = Lang::get('attributes.rating');

        return $setAnime;
    }

    /**
     * Добавление нового поста
     *
     * @return Factory|View
     */
    public function create()
    {
        $setAnime = self::setAnimeAdmin();

        return view('admin.anime.add', compact('setAnime'));
    }

    /**
     * Сохранение новой записи
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $updateAnime = self::$animeRepository->setAnime($request);
        if ($updateAnime) {
            return redirect()->route('admin.anime');
        }

        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }

    /**
     * Процедура обновления записи
     *
     * @param Request $request
     * @param string  $animeUrl
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $animeUrl): RedirectResponse
    {
        $updateAnime = self::$animeRepository->setAnime($request, $animeUrl);

        if ($updateAnime) {
            return redirect()->route('admin.anime');
        }

        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }

    /**
     * Удаление записи
     *
     * @param string $animeUrl
     *
     * @return RedirectResponse
     */
    public function destroy($animeUrl): RedirectResponse
    {
        $updateAnime = self::$animeRepository->delAnime($animeUrl);
        if ($updateAnime) {
            return redirect()->route('admin.anime.index');
        }

        return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
    }

    /**
     * Парсинг Видеобалансера
     *
     * @return mixed
     */
    public function CDNParse()
    {
        $arr = json_decode($_GET['arr'], true);

        return self::$CDNVideo->parseCurl($arr);
    }
}
