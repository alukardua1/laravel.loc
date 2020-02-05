<?php


namespace App\Repositories\Interfaces;


interface CustomRepositoryInterface
{
    public function getCustom($select = '*', $columns = '', $custom = '');
}
