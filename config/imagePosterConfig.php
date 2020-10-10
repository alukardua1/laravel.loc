<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

return [
    'imgColumns'        => 'poster',
    'patchImgPublic'    => 'public/anime/',
    'imgNamePrefix'     => 'poster_',
    'patchImgStorage'   => 'storage/anime/',
    'imgPostDir'        => 'anime/',
    'watermarkImg'      => 'admin/images/watermark.png',
    'watermarkPosition' => 'bottom-right',
    'watermark'         => [
        'X' => 10,
        'Y' => 10,
    ],
    'thumb'             => 'thumb/',
    'img'               => [
        'Width'  => 232,
        'Height' => 322,
    ],
    'extension' => [
        'jpg', 'png', 'bmp', 'webp'
    ]

];
