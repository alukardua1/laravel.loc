<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Translate;
use App\Repositories\Interfaces\TranslateRepositoryInterface;

/**
 * Class TranslateRepository
 *
 * @package App\Repositories
 */
class TranslateRepository implements TranslateRepositoryInterface
{
    public function getTranslate($id = null)
    {
        if ($id)
        {
            return abort(404);
        }else{
            return Translate::all();
        }
    }
}
