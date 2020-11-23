<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace App\Repository\Interfaces;


/**
 * Interface DLEParse
 *
 * @package App\Repository\Interfaces
 */
interface DLEParse
{
    /**
     * @return mixed
     */
    public function parseCategory();

    /**
     * @return mixed
     */
    public function parseUser();

    /**
     * @return mixed
     */
    public function parsePost();

    /**
     * @return mixed
     */
    public function parsePostCategory();

    /**
     * @return mixed
     */
    public function parseComments();

    /**
     * @return mixed
     */
    public function parseStudio();

    /**
     * @return mixed
     */
    public function parsePerson();
}
