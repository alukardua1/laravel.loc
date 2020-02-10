<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Observers;

use App\Models\Anime;
use Carbon\Carbon;
use Illuminate\Support\Str;


class AnimeObserver
{
    /**
     * @param  \App\Models\Anime  $anime
     */
    public function updating(Anime $anime)
    {
        $anime->url = Str::slug($anime->title);
        $anime->posted_at = request()->posted_at ? true : false;
        $anime->description = $anime->title;
    }

    /**
     * @param  \App\Models\Anime  $anime
     *
     * @todo Не забыть сменить $anime->metatitle, $anime->keywords, $anime->released, $anime->description
     */
    public function creating(Anime $anime)
    {
        $anime->url = Str::slug($anime->title);
        $anime->metatitle = $anime->title;
        $anime->aired_season = Carbon::parse($anime->aired_on)->format('Y');
        $anime->keywords = '11111';
        $anime->released = 'released';
        $anime->description = $anime->title;
    }

    /**
     * @param  \App\Models\Anime  $anime
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updated(Anime $anime)
    {
        return redirect()->route('admin.anime.edit', $anime->url)->send();
    }
}
