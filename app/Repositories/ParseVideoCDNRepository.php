<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Repositories\Interfaces\ParseVideoCDNRepositoryInterface;
use App\Traits\FunctionsTrait;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class ParseVideoCDNRepository
 *
 * @package App\Repositories
 */
class ParseVideoCDNRepository implements ParseVideoCDNRepositoryInterface
{
    use FunctionsTrait;

    /**
     * @var array
     */
    protected static $CDNVideoWa;
    /**
     * @var array
     */
    protected static $CDNVideoShiki;
    /**
     * @var array
     */
    protected static $CDNVideo;
    /**
     * @var Repository|Application|mixed
     */
    protected static $url;
    /**
     * @var Repository|Application|mixed
     */
    protected static $parseWA;
    /**
     * @var Repository|Application|mixed
     */
    protected static $parseShiki;
    /**
     * @var Repository|Application|mixed
     */
    protected static $token;
    /**
     * @var int
     */
    private static $worldArtId = 1;

    /**
     * ParseVideoCDNRepository constructor.
     */
    public function __construct()
    {
        self::$url = config('appSecondConfig.CDNUrl');
        self::$token = config('appSecondConfig.CDNToken');
        self::$parseWA = config('appSecondConfig.ParseWa');
        self::$parseShiki = config('appSecondConfig.ParseShiki');
    }

    /**
     * @param array $arr
     *
     * @return mixed
     */
    public function parseCurl($arr)
    {
        self::$CDNVideoWa = $this->parseIf(self::$parseWA, $arr['wa'], '&worldart_animation_id=');
        self::$CDNVideoShiki = $this->parseIf(self::$parseShiki, $arr['shiki'], '&shikimori_id=');
        self::$CDNVideo = array_merge(self::$CDNVideoWa['results'], self::$CDNVideoShiki['results']);

        return self::$CDNVideo;
    }

    /**
     * @param $configParse
     * @param $idParse
     * @param $searchApi
     *
     * @return mixed
     */
    private function parseIf($configParse, $idParse, $searchApi)
    {
        if ($configParse && $idParse) {
            $result = self::getCurl(self::$url . self::$token . $searchApi . $idParse);
            $result = json_decode($result, true);

            return $result;
        }

        $result = ['results' => []];

        return $result;
    }

    /**
     *
     */
    public function parseData()
    {
        // TODO: Implement parseData() method.
    }
}
