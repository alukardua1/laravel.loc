<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;


use App\Models\Anime;
use Illuminate\Http\Request;
use Image;
use Storage;
use Str;

/**
 * Trait UploadImageTrait
 *
 * @package App\Traits
 */
trait UploadImageTrait
{
    /**
     * Весь конфиг
     *
     * @var array
     */
    private static $config;

    /**
     * UploadImageTrait constructor.
     */
    public function __construct()
    {
        self::$config = config('imagePosterConfig');
        self::$config['patchSeparator'] = config('appSecondConfig.patchSeparator');
    }

    /**
     * Загружает постер к записи
     *
     * @param Anime   $updateAnime
     * @param Request $requestForm
     *
     * @return mixed
     */
    public function uploadImages($updateAnime, $requestForm)
    {
        $Extension = $requestForm[self::$config['imgColumns']]->getClientOriginalExtension();//Получает расширение файла
        if (in_array($Extension, self::$config['extension'])) {
            $fileName = self::$config['imgNamePrefix'] . $updateAnime->id . '.' . $Extension;// формирует имя файла
            $pathImg = self::$config['patchImgPublic'] . Str::slug(
                    $updateAnime->title
                ) . self::$config['patchSeparator'];          //путь к большой картинке
            $pathImgThumb = $pathImg . self::$config['thumb'];//путь к уменьшеной картинке
            $pathImgSave = self::$config['patchImgStorage'] . Str::slug(
                    $updateAnime->title
                ) . self::$config['patchSeparator'];
            $pathImgSaveThumb = $pathImgSave . self::$config['thumb'];

            Storage::putFileAs($pathImg, $requestForm[self::$config['imgColumns']], $fileName);//запись картинки
            Storage::putFileAs(
                $pathImgThumb,
                $requestForm[self::$config['imgColumns']],
                $fileName
            );//запись уменьшеной картинки

            $requestForm[self::$config['imgColumns']] = $fileName;//Запись в базу
            $img = Image::make($pathImgSave . $fileName);
            $img->insert(
                self::$config['watermarkImg'],
                self::$config['watermarkPosition'],
                self::$config['watermark']['X'],
                self::$config['watermark']['Y']
            );
            $img->save($pathImgSave . $fileName);
            $imgThumb = Image::make($pathImgSaveThumb . $fileName);
            $imgThumb->resize(self::$config['img']['Width'], self::$config['img']['Height']);
            $imgThumb->save($pathImgSaveThumb . $fileName);

            return $requestForm;
        }
        return 'error';
    }
}
