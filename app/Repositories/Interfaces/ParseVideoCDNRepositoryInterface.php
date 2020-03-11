<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


interface ParseVideoCDNRepositoryInterface
{
	public function parseCurl($urlApi);

	public function parseData();
}