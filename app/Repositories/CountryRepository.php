<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{
    /**
     * @param $selectRows
     *
     * @return mixed
     */
    public function getCountry($selectRows)
    {
        $result = Country::select($selectRows)
            ->get();

        return $result;
    }
}
