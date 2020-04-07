<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;


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
	 * @var string
	 */
	private static $imgColumns        = 'poster';
	private static $patchImgPublic    = 'public/anime/';
	private static $imgName           = 'poster_';
	private static $patchImgStorage   = 'storage/anime/';
	private static $imgPostDir        = 'anime/';
	private static $watermarkImg      = 'admin/images/watermark.png';
	private static $watermarkPosition = 'bottom-right';
	private static $watermarkX        = 10;
	private static $watermarkY        = 10;
	private static $patchSeparator    = '/';
	private static $thumb             = 'thumb/';
	private static $imgWidth          = 232;
	private static $imgHeight         = 322;

	/**
	 * Загружает постер к записи
	 *
	 * @param  \App\Models\Anime         $updateAnime
	 * @param  \Illuminate\Http\Request  $requestForm
	 *
	 * @return mixed
	 */
	public function uploadImages($updateAnime, $requestForm)
	{
		$Extension = $requestForm[self::$imgColumns]->getClientOriginalExtension(
		);                                                                                          //Получает расширение файла
		$fileName = self::$imgName . $updateAnime->id . '.' . $Extension;                           // формирует имя файла
		$pathImg = self::$patchImgPublic . Str::slug(
				$updateAnime->title
			) . self::$patchSeparator;                                                              //путь к большой картинке
		$pathImgThumb = $pathImg . self::$thumb;                                                    //путь к уменьшеной картинке
		$pathImgSave = self::$patchImgStorage . Str::slug($updateAnime->title) . self::$patchSeparator;
		$pathImgSaveThumb = $pathImgSave . self::$thumb;

		Storage::putFileAs($pathImg, $requestForm[self::$imgColumns], $fileName);     //запись картинки
		Storage::putFileAs($pathImgThumb, $requestForm[self::$imgColumns], $fileName);//запись уменьшеной картинки

		$requestForm[self::$imgColumns] = $fileName;//Запись в базу
		$img = Image::make($pathImgSave . $fileName);
		$img->insert(self::$watermarkImg, self::$watermarkPosition, self::$watermarkX, self::$watermarkY);
		$img->save($pathImgSave . $fileName);
		$imgThumb = Image::make($pathImgSaveThumb . $fileName);
		$imgThumb->resize(self::$imgWidth, self::$imgHeight);
		$imgThumb->save($pathImgSaveThumb . $fileName);

		return $requestForm;
	}
}
