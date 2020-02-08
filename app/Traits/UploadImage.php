<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

/**
 * Created by PhpStorm
 * User: alukardua
 * Date: 08.02.2020
 */

namespace App\Traits;



use Image;
use Storage;
use Str;

trait UploadImage
{
    public function uploadImages($updateAnime, $requestForm)
    {
        if (file_exists('public/anime/'.$updateAnime->poster)) {
            $requestForm = $this->deleteAvatar($updateAnime, $requestForm);
        }

        $Extension = $requestForm['poster']->getClientOriginalExtension();
        $fileName = 'poster_'.$updateAnime->id.'.'.$Extension;

        Storage::putFileAs(
            'public/anime/'.Str::slug($updateAnime->title).'/', $requestForm['poster'], $fileName
        );

        $requestForm['poster'] = 'anime/'.Str::slug($updateAnime->title).'/'.$fileName;
        $img = Image::make('storage/anime/'.Str::slug($updateAnime->title).'/'.$fileName);
        $img->insert('admin/images/watermark.png', 'bottom-right', 10, 10);
        $img->save('storage/anime/'.Str::slug($updateAnime->title).'/'.$fileName);

        return $requestForm;
    }
}
