@extends('layouts.app')
@section('title',  $category->title ?? config('app.name'))
@section('content')
    <article itemscope itemtype="https://schema.org/Movie">
        <div class="row">
            <div class="col-md-11">
                <h3 class="font-weight-bold mb-3">
                    <strong>
                        {{ $animePost->title }}{{ isset($animePost->romaji) ? ' / ' .$animePost->romaji: '' }}
                        {{-- {include
                         file="engine/modules/title.php?tip=[xfvalue_tip]&seriya=[xfvalue_seriya]&serias_col=[xfvalue_serias-col]"}--}}
                    </strong>
                </h3>
            </div>
            <div class="col-md-1">
                {{--@if (Auth::check())
                    <favorite
                        :post={{ $animePost->id }} :favorited={{ $animePost->favorited() ? 'true' : 'false' }}>
                    </favorite>
                @endif--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-weight-bold mb-3 font-italic">в озвучке: </h4>
            </div>
            @if (Auth::check())
                <div class="col-md-12">
                    {{--<votes :post={{ $animePost->id }}
                        :votes={{ $animePost->votes() ? 'true' : 'false' }}></votes>--}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                            <img class="img-fluid"
                                 src="{{ isset($animePost->poster) ? asset('storage/'. $animePost->poster) : asset('images/no_poster.jpg')}}"
                                 alt="{title}">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="ya-share2"
                             data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,telegram"></div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        {{-- {include file="modules/trailer-modal.tpl"}--}}
                    </div>
                </div>
            </div>
            <div class="col-md-7 review">
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Ссылки:</span>
                    </div>
                    <div class="col-md-8">
                            <span class="float-xl-right url">
                                <a itemprop="url"
                                   href="http://www.world-art.ru/animation/animation.php?id={{ $animePost->xfield['world-art-id'] }}"
                                   target="_blank" rel="nofollow">World-Art</a>,
                                <a itemprop="url" href="https://www.kinopoisk.ru/film/{{ $animePost->kp_id }}"
                                   target="_blank" rel="nofollow">КиноПоиск</a>,
                                <a itemprop="url"
                                   href="https://myanimelist.net/anime/{{ $animePost->xfield['myanimelist-id'] }}"
                                   target="_blank" rel="nofollow">MyAnimeList</a>,
                                <a itemprop="url" href="https://anidb.net/anime/{{ $animePost->anidb_id }}"
                                   target="_blank" rel="nofollow">AniDb</a>
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Трансляция:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="sdDatePublished" class="float-xl-right url">
                                в {{ $animePost->delivery_time }} {!! $animePost->formatTime !!} на {{ $animePost->chanal }}
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Студия:</span>
                    </div>
                    <div class="col-md-8">
                        {{--<span itemprop="publisher"
                              class="float-xl-right url">{{ $animePost->studio_anime->title }}</span>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Оригинальное название:</span>
                    </div>
                    <div class="col-md-8">
                        <span itemprop="name" class="float-xl-right url">{{ $animePost->japanese }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Английское название:</span>
                    </div>
                    <div class="col-md-8">
                        <span itemprop="name" class="float-xl-right url">{{ $animePost->english }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Название (ромадзи):</span>
                    </div>
                    <div class="col-md-8">
                        <span itemprop="name" class="float-xl-right url">{{ $animePost->romaji }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Сезон:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="sdDatePublished" class="float-xl-right url">
                                {{ $animePost->aired_season }}
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Страна:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="creator" class="float-xl-right url">
                                {{ $animePost->getCountry->title }}
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Жанр:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="url" class="float-xl-right url">
                                @foreach($animePost->getCategory as $category)
                                    @if ($loop->last)
                                        <a href="{{ route('category', $category->url) }}">{{ $category->title }}</a>
                                    @else
                                        <a href="{{ route('category', $category->url) }}">{{ $category->title }}</a> /
                                    @endif
                                @endforeach
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Тип:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="timeRequired" class="float-xl-right url">
                                {{--{{ $kind[$animePost->kind] }}--}} ({{ $animePost->count_series }} эп.) {{ $animePost->duration }} мин.
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Выпуск:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="sdDatePublished" class="float-xl-right url">
                                с {{ $animePost->aired_on }} по {{ $animePost->released_on }}
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Рейтинг:</span>
                    </div>
                    <div class="col-md-8">
                        {!! $animePost->rating_html !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Режиссер:</span>
                    </div>
                    <div class="col-md-8">
                        <span itemprop="character" class="float-xl-right url"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Актеры:</span>
                    </div>
                    <div class="col-md-8">
                        <span itemprop="character" class="float-xl-right url"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Автор оригинала:</span>
                    </div>
                    <div class="col-md-8">
                        <span itemprop="character" class="float-xl-right url"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Рейтинг на сайте:</span>
                    </div>
                    <div class="col-md-8">
                        <span class="float-xl-right url">{{$animePost->sum_votes}} (Голосов: {{$animePost->count_votes}})</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h3 class="font-weight-bold mb-3">
                    Оисание
                </h3>
                <p class="dark-grey-text">
                    {!! $animePost->content !!}
                </p>
            </div>
            {{--<div class="col-md-12">
                <h3 class="font-weight-bold mb-3">
                    Видео
                </h3>
                <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#player1-md" role="tab"
                           aria-controls="home-md"
                           aria-selected="true">Плеер 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#player2-md" role="tab"
                           aria-controls="profile-md"
                           aria-selected="false">Плеер 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#player3-md" role="tab"
                           aria-controls="contact-md"
                           aria-selected="false">Плеер 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#player4-md" role="tab"
                           aria-controls="contact-md"
                           aria-selected="false">Плеер 4</a>
                    </li>
                </ul>
                <div class="tab-content card pt-5" id="myTabContentMD">
                    <div class="tab-pane fade show active" id="player1-md" role="tabpanel"
                         aria-labelledby="home-tab-md">
                        --}}{{--{hdlight-player}--}}{{--
                    </div>
                    <div class="tab-pane fade" id="player2-md" role="tabpanel" aria-labelledby="profile-tab-md">
                        --}}{{-- [xfnotgiven_videocdn]Видео временно отсутствует[/xfnotgiven_videocdn]
                         [videocdn-player]{videocdn-player}[/videocdn-player]--}}{{--
                    </div>
                    <div class="tab-pane fade" id="player3-md" role="tabpanel" aria-labelledby="contact-tab-md">
                        --}}{{--[xfnotgiven_collaps]Видео временно отсутствует[/xfnotgiven_collaps]
                        [xfgiven_collaps]
                        <iframe src="[xfvalue_collaps]" allowfullscreen="" webkitallowfullscreen=""
                                mozallowfullscreen="" oallowfullscreen="" msallowfullscreen="" width="795"
                                height="497"></iframe>
                        [/xfgiven_collaps]--}}{{--
                    </div>
                    <div class="tab-pane fade" id="player3-md" role="tabpanel" aria-labelledby="contact-tab-md">
                        --}}{{--[xfnotgiven_hdvb]Видео временно отсутствует[/xfnotgiven_hdvb]
                        [xfgiven_hdvb][hdvb="[xfvalue_hdvb]"][/xfgiven_hdvb]--}}{{--
                    </div>
                </div>
            </div>--}}
            {{--<div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold mb-3">Похожее</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">--}}{{--{related-news}--}}{{--</div>
                    </div>
                </div>
            </div>--}}
            <div class="col-md-12">
                {{-- @include('comments.area', ['comments' => $comments, 'commentsCount' => $animePost])--}}
            </div>
    </article>
@endsection
