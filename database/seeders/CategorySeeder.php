<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace Database\Seeders;

use App\Repository\Interfaces\DLEParse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    protected $category;

    public function __construct(DLEParse $DLEParse)
    {
        $this->category = $DLEParse;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = $this->category->parseCategory();
        foreach ($categorys as $cat)
        {
            $data = $cat;
        }

        DB::table('categories')->insert($categorys);
    }
}
