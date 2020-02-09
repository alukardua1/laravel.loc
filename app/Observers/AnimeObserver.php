<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Observers;

use App\Models\Anime;
use Illuminate\Support\Str;


class AnimeObserver
{
    public function updating(Anime $anime)
    {
        $anime->url = Str::slug($anime->title);
    }

    public function updated(Anime $anime)
    {
        return redirect()->route('admin.anime.edit', $anime->url)->send();
    }
}
