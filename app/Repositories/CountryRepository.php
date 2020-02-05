<?php


namespace App\Repositories;


use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{
    public function getCountry($selectRows)
    {
        $result = Country::select($selectRows)
            ->get();

        return $result;
    }
}
