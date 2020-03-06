@extends($theme.'/layouts.app')
@section('title',  $animePost->title ?? config('appSecondConfig.nameSite'))
@section('description',  $animePost->description ?? config('appSecondConfig.descriptionSite'))
@section('content')
    <article itemscope itemtype="https://schema.org/Movie">
        <div class="row">
            <div class="col-md-11">
                <h3 class="font-weight-bold mb-3">
                    <strong>
                        {{ $animePost->title }}{{ isset($animePost->romaji) ? ' / ' .$animePost->romaji: '' }}
                        @if($animePost->tip === 'tv')
                            [1-{{$animePost->current_series}} из {{$animePost->count_series}}]
                        @else
                            [{{$animePost->current_series}} из {{$animePost->count_series}}]
                        @endif
                        @if(Auth::check() && Auth::user()->group_id == 1)
                            <a target="_blank" href="{{route('admin.anime.edit', $animePost->id)}}"
                               title="Редактировать {{$animePost->title}}"><i class="far fa-edit"></i></a>
                        @endif
                    </strong>
                </h3>
            </div>
            <div class="col-md-1">
                @if (Auth::check())
                    <favorite
                            :post={{ $animePost->id }} :favorited={{ $animePost->favorited() ? 'true' : 'false' }}>
                    </favorite>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-weight-bold mb-3 font-italic">в озвучке:
                    @foreach($animePost->getTranslate as $translate)
                        @if ($loop->last) {{ $translate->title }} @else
                            {{ $translate->title }},
                        @endif
                    @endforeach
                </h4>
            </div>
            @if (Auth::check())
                <div class="col-md-12">
                    <votes :post={{ $animePost->id }}
                            :votes={{ $animePost->votes() ? 'true' : 'false' }}></votes>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                            <img class="img-fluid"
                                 src="{{ isset($animePost->poster) ? asset('storage/'. $animePost->poster) : asset('theme/'.$theme.'/images/no_poster.jpg')}}"
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
                                @if($animePost->wa_id)
                                    <a itemprop="url"
                                       href="http://www.world-art.ru/animation/animation.php?id={{ $animePost->wa_id }}"
                                       target="_blank" rel="nofollow">World-Art</a>
                                @endif
                                @if($animePost->kp_id)
                                    / <a itemprop="url" href="https://www.kinopoisk.ru/film/{{ $animePost->kp_id }}"
                                         target="_blank" rel="nofollow">КиноПоиск</a>
                                @endif
                                @if($animePost->mal_id)
                                    / <a itemprop="url"
                                         href="https://myanimelist.net/anime/{{ $animePost->mal_id }}"
                                         target="_blank" rel="nofollow">MyAnimeList</a>
                                @endif
                                @if($animePost->anidb_id)
                                    / <a itemprop="url" href="https://anidb.net/anime/{{ $animePost->anidb_id }}"
                                         target="_blank" rel="nofollow">AniDb</a>
                                @endif
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Трансляция:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="sdDatePublished" class="float-xl-right url">
                                @if($animePost->delivery_time)
                                    в {{ \Carbon\Carbon::parse($animePost->delivery_time)->format('H:i') }}
                                    {!! $animePost->day !!}
                                @endif
                                @if($animePost->tv_canal)
                                    на
                                    <a href="{{route('custom', ['variable'=>$animePost->tv_canal, 'custom'=>'tv_canal'])}}">
                                            {{ $animePost->tv_canal }}
                                        </a>
                                @endif
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Студия:</span>
                    </div>
                    <div class="col-md-8">
                        <span itemprop="publisher"
                              class="float-xl-right url">{{ $animePost->studio_anime->title ?? '' }}</span>
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
                                {{ $animePost->seasons }}
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
                                <a href="{{route('custom', ['variable'=>$animePost->tip, 'custom'=>'tip'])}}">
                                    {{$tipRu[$animePost->tip]}}
                                </a> ({{ $animePost->count_series }} эп.) {{ $animePost->duration }} мин.
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Выпуск:</span>
                    </div>
                    <div class="col-md-8">
                            <span itemprop="sdDatePublished" class="float-xl-right url">
                                с {{ \Carbon\Carbon::parse($animePost->aired_on)->format('d.m.Y') }}
                                по {{ \Carbon\Carbon::parse($animePost->released_on)->format('d.m.Y') }}
                            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="title-info">Рейтинг:</span>
                    </div>
                    <div class="col-md-8">
                        <span class="float-xl-right">{{$kind[$animePost->rating]}}</span>
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
            <div class="col-md-12">
                <h3 class="font-weight-bold mb-3">
                    Видео
                </h3>
                <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#player1-md" role="tab"
                           aria-controls="home-md"
                           aria-selected="true">Плеер 1</a>
                    </li>
                </ul>
                <div class="tab-content card pt-5" id="myTabContentMD">
                    <div class="tab-pane fade show active" id="player1-md" role="tabpanel"
                         aria-labelledby="home-tab-md">
                        <iframe src="{{$animePost->video}}" width="100%"
                                height="497" frameborder="0" allowfullscreen>
                        </iframe>

                    </div>
                </div>
            </div>
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
                 @include($theme . '.comments.area', ['comments' => $comments, 'commentsCount'=>$commentsCount])
            </div>
    </article>
@endsection
