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
 * Trait UploadImage
 *
 * @package App\Traits
 */
trait UploadImage
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

	/**
	 * Загружает постер к записи
	 *
	 * @param $updateAnime
	 * @param $requestForm
	 *
	 * @return mixed
	 */
	public function uploadImages($updateAnime, $requestForm)
	{
		if (file_exists(self::$patchImgPublic.$updateAnime->poster)) {
			$requestForm = $this->deleteAvatar($updateAnime, $requestForm);
		}

		$Extension = $requestForm[self::$imgColumns]->getClientOriginalExtension();
		$fileName = self::$imgName.$updateAnime->id.'.'.$Extension;

		Storage::putFileAs(
			self::$patchImgPublic.Str::slug($updateAnime->title).self::$patchSeparator,
			$requestForm[self::$imgColumns],
			$fileName
		);

		$requestForm[self::$imgColumns] = self::$imgPostDir.Str::slug(
				$updateAnime->title
			).self::$patchSeparator.$fileName;
		$img = Image::make(self::$patchImgStorage.Str::slug($updateAnime->title).self::$patchSeparator.$fileName);
		$img->insert(self::$watermarkImg, self::$watermarkPosition, self::$watermarkX, self::$watermarkY);
		$img->save(self::$patchImgStorage.Str::slug($updateAnime->title).self::$patchSeparator.$fileName);

		return $requestForm;
	}
}
