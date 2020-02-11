<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="scrollbar scrollbar-black bordered-black square thin">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - @yield('description')</title>
    <meta name="description" content="@yield('title') - @yield('description')">
    <meta name="HandheldFriendly" content="true">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="user-scalable=0, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="fb:pages" content="363073333807545"/>
    <link href="{{ asset('theme/'.$theme.'/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/blog.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/engine.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/owl.theme.default.css') }}" rel="stylesheet">
    <link href="{{ asset('images/favicon.ico') }}" rel="shortcut icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link
        href="https://fonts.googleapis.com/css?family=Bangers|Stalinist+One|Teko|Lobster|Marck+Script|Russo+One|Playfair+Display:700,900"
        rel="stylesheet">
</head>
<body class="force-overflow">
<div id="app">
    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="text-muted fas fa-rss" href="/rss.xml"></a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo logo text-dark"
                       href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    @include($theme.'/login')
                </div>
            </div>
        </header>
        <div class="nav-scroller py-1 mb-2">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link" href="/top-100.html"><i class="fas fa-medal"></i><i class="fas fa-medal"></i><i
                            class="fas fa-medal"></i> ТОП-100 <i class="fas fa-medal"></i><i class="fas fa-medal"></i><i
                            class="fas fa-medal"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/xfsearch/ongoing/"><i class="fas fa-tv"></i> Онгоинги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pravoobladatelyam.html"><i class="fab fa-studiovinari"></i>
                        Правообладателям</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rules.html"><i class="fas fa-book"></i> Правила</a>
                </li>
                <li class="nav-item">
                    <a id="modalActivate" class="nav-link" data-toggle="modal" data-target="#studios"><i
                            class="fab fa-studiovinari"></i> Студии</a>
                </li>
                <li class="nav-item">
                    <a id="modalActivate" class="nav-link" data-toggle="modal" data-target="#scoring"><i
                            class="fas fa-language"></i> Озвучивание</a>
                </li>
                <li class="nav-item">
                    <a id="modalActivate" class="nav-link" data-toggle="modal" data-target="#year"><i
                            class="far fa-calendar-alt"></i> Год выпуска</a>
                </li>
                <li class="nav-item">
                    <a id="modalActivate" class="nav-link" data-toggle="modal" data-target="#genre"><i
                            class="fas fa-bars"></i> Жанры</a>
                </li>
            </ul>
        </div>
        @available('home')
        <div class="card">
            <div class="card-body">
                <div id="carousel" class="owl-carousel owl-theme">
                    @include($theme.'/carousel')
                </div>
            </div>
        </div>
        @endavailable
    </div>
    <main role="main" class="container">
        <div class="row">
            <div class="col-xl-9 blog-main">
                {{--[sort]
                <div id="sort">
                    <b><i class="fas fa-sort"></i> Сортировать по</b>
                    {sort}
                </div>
                [/sort]--}}
                @available('home')
                <search></search>
                @endavailable
                <section class="my-5">
                    @available('category.show')
                    <h2 class="h1-responsive font-weight-bold text-center my-5">@yield('title-category')</h2>
                    <p class="text-center dark-grey-text w-responsive mx-auto mb-5">@yield('description')</p>
                    <hr class="my-5">
                    @endavailable
                    <div class="container">
                        @yield('content')
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-12 mt-1 wow fadeIn" data-wow-delay="0.2s"
                 style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">
                <section class="section my-5">
                    <div class="card card-body pb-0">
                        <div class="single-post">
                            <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                <strong>Тип</strong>
                            </p>
                            <ul class="list-group my-4">

                                @foreach($tip as $key => $value)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href='{{route('tip', $key)}}'>
                                            <p class="mb-0">{{$tipRu[$key]}}</p>
                                        </a>
                                        <span class="badge teal badge-pill font-small float-right">{{$value}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
                @available('home')
                <section class="section my-5">
                    <div class="card card-body pb-0">
                        <div class="single-post">
                            <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                <strong>Статистика</strong>
                            </p>
                            <ul class="list-group my-4">
                                {{-- {include file="engine/modules/lightstat.php"}--}}
                            </ul>
                        </div>
                    </div>
                </section>

                <section class="section my-5">
                    <div class="card card-body pb-0">
                        <div class="single-post">
                            <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                <strong>Мы Вконтакте</strong>
                            </p>
                            <ul class="list-group my-4">
                                {{-- {banner_vk}--}}
                            </ul>
                        </div>
                    </div>
                </section>

                <section class="section my-5">
                    <div class="card card-body pb-0">
                        <div class="single-post">
                            <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                <strong>Мы FaceBook</strong>
                            </p>
                            <ul class="list-group my-4">
                                {{-- {banner_fb}--}}
                            </ul>
                        </div>
                    </div>
                </section>
                @endavailable
            </div>
        </div>
    </main>
    <footer class="page-footer font-small unique-color-dark pt-4">
        <div class="container">
            <ul class="list-unstyled list-inline text-center py-2">
                <li class="list-inline-item">
                    <h5 class="mb-1">Описание нашего сайта</h5>
                </li>
                <li class="list-inline-item">
                    Многие которые смотрят аниме в первый раз, воспринимают аниме как простые мультики. Но они
                    ошибаются,
                    аниме про любовь, школу, вампиров, магию, романтику, роботов и многое другое, отличаются от
                    мультиков.
                    Аниме это искусство с глубоким смыслом и как правило в основе аниме, манга или ранобе, и что более
                    редко, аниме по известной литературе. Если вам лет так 40 и вы смотрите аниме, вам не к чему
                    стыдится,
                    так как у аниме нет возрастных ограничений, не считая хентайчик у которого (18+) =) Ну а остальное
                    аниме
                    вы найдете на AnimeFree, который специально был создан чтоб вы могли смотреть новые аниме онлайн
                    бесплатно и без регистраций. Если вам нравится аниме, добро пожаловать друг - анимешник!
                </li>
            </ul>
            <div class="list-unstyled list-inline text-center py-2">

            </div>
        </div>
        <div class="footer-copyright text-center py-3">
            © Design by:<a target="_blank" href="/"> AnimeFree</a>
            © Powered by:<a target="_blank" href="https://dle-news.ru/"> SoftNews Media Group</a>
        </div>
    </footer>
    <button class="btn btn-outline-default waves-effect" id="toTop" title="На вверх"><i class="fas fa-arrow-up"></i>
    </button>
</div>
@include($theme.'/category')
@include($theme.'/year')
{{--{include file="modules/modal-studios.tpl"}
{include file="modules/modal-scoring.tpl"}
{include file="modules/modal-year.tpl"}--}}
{{--<script src="{{ asset('js/jquery-3.4.1.min.js') }}" defer></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.0/vue.js"></script>
<script src="{{ asset('theme/'.$theme.'/js/app.js') }}" defer></script>
<script src="{{ asset('theme/'.$theme.'/js/popper.min.js') }}" defer></script>
{{--<script src="{{ asset('theme/'.$theme.'/js/bootstrap.js') }}" defer></script>--}}
<script src="{{ asset('theme/'.$theme.'/js/mdb.js') }}" defer></script>
<script src="{{ asset('theme/'.$theme.'/js/owl.carousel.js') }}" defer></script>
<script src="{{ asset('theme/'.$theme.'/js/chosen.jquery.js') }}" defer></script>
<script src="{{ asset('theme/'.$theme.'/js/my.js') }}" defer></script>
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
</body>
</html>
