<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace App\Repository;


use App\Repository\Interfaces\DLEParse;
use App\Traits\CurlTrait;
use File;
use Illuminate\Support\Facades\DB;
use Storage;
use Str;

/**
 * Class DLEParseRepository
 *
 * @package App\Repository
 */
class DLEParseRepository implements DLEParse
{
    use CurlTrait;

    /**
     * @var string[]
     */
    protected static $array_tip = [
        'ТВ'                => 'tv',
        'OVA'               => 'ova',
        'фильм'             => 'movie',
        'ONA'               => 'ona',
        'спешл'             => 'special',
        'музыкальное видео' => 'music',
    ];

    /**
     * @return mixed
     */
    public function parseCategory()
    {
        $categories = DB::connection("mysql2")->table('dle_category')->select(
            ['id', 'name', 'alt_name', 'fulldescr']
        )->get();
        foreach ($categories as $value) {
            $category[] = [
                'id'          => $value->id,
                'title'       => $value->name,
                'url'         => $value->alt_name,
                'description' => $value->fulldescr,
            ];
        }
        return $category;
    }

    /**
     * @return mixed
     */
    public function parseUser()
    {
        $users = DB::connection("mysql2")->table('dle_users')->select(['*'])->get();
        foreach ($users as $user) {
            $result[] = [
                'id'       => $user->user_id,
                'login'    => $user->name,
                'name'     => $user->fullname,
                'group_id' => $user->user_group,
                'email'    => $user->email,
            ];
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function parsePost()
    {
        $posts = DB::connection("mysql2")->table('dle_post')->select(['*'])->get();
        foreach ($posts as $post) {
            $xfields = explode('||', $post->xfields);
            foreach ($xfields as $value) {
                $xfield = explode('|', $value);
                $xfield1[$xfield['0']] = $xfield['1'];
            }
            switch ($xfield1['status']) {
                case 'released':
                    $xfield1['anons'] = 0;
                    $xfield1['ongoing'] = 0;
                    break;
                case 'ongoing':
                    $xfield1['ongoing'] = 1;
                    break;
                case 'anons':
                    $xfield1['anons'] = 1;
                    break;
            }
            switch ($xfield1['tip']) {
                case 'ТВ':
                    $kind = 3;
                    break;
                case 'OVA':
                    $kind = 1;
                    break;
                case 'фильм':
                    $kind = 2;
                    break;
                case 'ONA':
                    $kind = 4;
                    break;
                case 'спешл':
                    $kind = 6;
                    break;
                case 'музыкальное видео':
                    $kind = 5;
                    break;
            }
            preg_match_all('/[0-5][0-9]:[0-5][0-9]/', $xfield1['translyaciya'], $xfield1['broadcast']);
            $image = $this->imageFunc($post, 'http://anime-free.ru/uploads/posts/' . $xfield1['izobrazhenie']);

            $result[] = [
                'id'                 => $post->id,
                'user_id'            => 1,
                'original_img'       => $image['original_img'],
                'preview_img'        => $image['preview_img'],
                'anons'              => $xfield1['anons'],
                'ongoing'            => $xfield1['ongoing'],
                'metatitle'          => $post->metatitle,
                'keywords'           => $post->keywords,
                'name'               => $post->title,
                'russian'            => $post->title,
                'url'                => $post->alt_name,
                'kind'               => $kind,
                'status'             => $xfield1['status'],
                'broadcast'          => $xfield1['broadcast'][0][0] ?? '',
                'aired_season'       => $xfield1['sezon'],
                'episodes'           => $xfield1['serias-col'],
                'episodes_aired'     => $xfield1['seriya'],
                'aired_on'           => date('Y-m-d', strtotime($xfield1['data-vypuska'])),
                'released_on'        => date('Y-m-d', strtotime($xfield1['data-okonchaniya'])),
                'rating'             => $xfield1['rating'],
                'english'            => $xfield1['po-angliyski'],
                'japanese'           => $xfield1['po-yaponski'],
                'synonyms'           => $xfield1['nazvanie-romadzi'],
                'duration'           => $xfield1['dlitelnost'],
                'description'        => $post->short_story,
                'description_html'   => $post->short_story,
                'description_source' => $post->short_story,
                'franchise'          => '',
                'player'             => $xfield1['kodik'],
                'treyler'            => $xfield1['treyler'],
                'created_at'         => date('Y-m-d', strtotime($post->date)),
                'updated_at'         => date('Y-m-d', strtotime($post->date)),
            ];
        }

        return $result;
    }

    private function imageFunc($anime, $image)
    {
        $path_info = pathinfo($image);
        $Extension = $path_info['extension'];
        $fileName = 'anime_' . $anime->id . '.' . $Extension;
        $pathImg = 'anime/' . $anime->id . '_' . Str::slug($anime->title) . '/';//путь к большой картинке
        $pathImgThumb = $pathImg . 'thumb/';//путь к уменьшеной картинке
        $pathImgSave = 'anime/' . $anime->id . '_' . Str::slug($anime->title) . '/';
        $pathImgSaveThumb = $pathImgSave . 'thumb';

        $imgName = $pathImg . $fileName;
        if (!Storage::exists($imgName)) {
            Storage::putFileAs($pathImg, $image, $fileName);//запись картинки
            Storage::putFileAs($pathImgThumb, $image, $fileName);//запись уменьшеной картинки
        }

        $result = [
            'original_img' => $pathImg . $fileName,
            'preview_img'  => $pathImgThumb . $fileName,
        ];

        return $result;
    }

    /**
     * @return mixed
     */
    public function parsePostCategory()
    {
        $category = DB::connection("mysql2")->table('dle_post')->select(['*'])->get();
        foreach ($category as $cat) {
            $categ = explode(',', $cat->category);
            foreach ($categ as $value) {
                $result[] = [
                    'anime_id'    => $cat->id,
                    'category_id' => $value
                ];
            }
        }

        return $result;
    }

    /**
     * @return mixed|void
     */
    public function parseComments()
    {
        //$comments = DB::connection("mysql2")->table('dle_comments')->select(['*'])->get();
    }

    /**
     * @return mixed|void
     */
    public function parsePerson()
    {
        // TODO: Implement parsePerson() method.
    }

    /**
     * @return mixed|void
     */
    public function parseStudio()
    {
        $url = 'https://shikimori.one/api/studios';

        $studios = $this->getCurl($url);

        foreach ($studios as $studio) {
            $result[] = [
                'name'          => $studio['name'],
                'filtered_name' => $studio['filtered_name'],
                'url'           => Str::slug($studio['name']),
            ];
        }

        return $result;
    }
}
