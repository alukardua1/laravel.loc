<!doctype html>
<html {{ str_replace('_', '-', app()->getLocale()) }}>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - @yield('description')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="{{ asset('theme/'.$theme.'/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/'.$theme.'/css/style.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark black">
        <a class="navbar-brand" href="{{route('home')}}">@yield('title')</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="basicExampleNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            {{--<form class="form-inline">
                <div class="md-form my-0">
                    <input class="form-control mr-sm-2" type="search" id="story" name="story" placeholder="Поиск по сайту..." aria-label="Поиск по сайту...">
                </div>
            </form>--}}
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item avatar dropdown">
                    @include($theme.'.modules.login')
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>

</main>
<footer>

</footer>
<script src="{{ asset('theme/'.$theme.'/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('theme/'.$theme.'/js/app.js') }}"></script>
<script src="{{ asset('theme/'.$theme.'/js/popper.min.js') }}"></script>
<script src="{{ asset('theme/'.$theme.'/js/mdb.min.js') }}"></script>
</body>
</html>
