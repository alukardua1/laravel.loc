<?php


namespace App\Repositories\Interfaces;


interface CustomRepositoryInterface
{
    public function getCustom($columns, $custom, $paginate);
}
