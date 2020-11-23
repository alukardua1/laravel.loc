<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudiosSeeder extends Seeder
{
    protected $studiosRepository;

    public function __construct(DLEParseRepository $DLEParseRepository)
    {
        $this->studiosRepository = $DLEParseRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studios = $this->studiosRepository->parseStudio();
        foreach ($studios as $studio) {
            DB::table('studios')->insert($studio);
        }
    }
}
