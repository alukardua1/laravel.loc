<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VoteRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class VoteController extends Controller
{
    private static $voteRepository;

    public function __construct(VoteRepositoryInterface $repository)
    {
        parent::__construct();
        self::$voteRepository = $repository;
    }

    public function plusVotes($id): RedirectResponse
    {
        self::$voteRepository->plusVotes($id);

        return back();
    }

    public function minusVotes($id): RedirectResponse
    {
        self::$voteRepository->minusVotes($id);

        return back();
    }
}
