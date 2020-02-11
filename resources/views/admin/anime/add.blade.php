@extends('admin.layouts.dashboard')
@section('title', 'Добавление аниме')
@section('content')
    <form method="POST" action="{{ route('admin.anime.save') }}"
          enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="md-form">
            <input name="user_id" type="hidden" value="{{Auth::user()->id}}">
            <input type="text" class="form-control" value="{{Auth::user()->login}}">
        </div>
        <div class="md-form">
            <label for="title" class="title-info">Заголовок</label>
            <input type="text" id="title" name="title" class="form-control" value="">
        </div>
        <div class="row">
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="japanese" name="japanese" class="form-control"
                           value="">
                    <label for="japanese" class="title-info">Японское название</label>
                </div>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="english" name="english" class="form-control"
                           value="">
                    <label for="english" class="title-info">Английское название</label>
                </div>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="romaji" name="romaji" class="form-control"
                           value="">
                    <label for="romaji" class="title-info">Название (ромадзи)</label>
                </div>
            </div>
        </div>
        <select name="genre[]" class="mdb-select md-form" multiple>
            <option value="" disabled selected>Выберите категорию</option>
            @foreach($category as $key => $value)
                <option value="{{$value->id}}">{{$value->title}}</option>
            @endforeach
        </select>
        <div class="md-form">
            <textarea id="content" name="content" class="md-textarea form-control"
                      rows="10"></textarea>
        </div>
        <div class="md-form">
            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span>Choose file</span>
                    <input type="file" name="poster">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload your file">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="md-form">
                    <label for="wa_id" class="title-info">Id World-art</label>
                    <input type="text" id="wa_id" name="wa_id" class="form-control" value="">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="shikimori_id" class="title-info">ID Shikimori</label>
                    <input type="text" id="shikimori_id" name="shikimori_id" class="form-control"
                           value="">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="kp_id" class="title-info">ID Кинопоиск</label>
                    <input type="text" id="kp_id" name="kp_id" class="form-control" value="">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="mal_id" class="title-info">ID MaiAnimeList</label>
                    <input type="text" id="mal_id" name="mal_id" class="form-control" value="">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="anidb_id" class="title-info">ID AniDB</label>
                    <input type="text" id="anidb_id" name="anidb_id" class="form-control"
                           value="">
                </div>
            </div>
            <div class="col-2">

            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="md-form">
                    <input type="time" id="delivery_time" name="delivery_time" class="form-control"
                           value="">
                    <label for="delivery_time" class="title-info">Время показа</label>
                </div>
            </div>
            <div class="col-9">
                <div class="md-form">
                    <input type="text" id="tv_canal" name="tv_canal" class="form-control"
                           value="">
                    <label for="tv_canal" class="title-info">Телеканал</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <select name="country_id" class="mdb-select md-form">
                    <option value="" disabled selected>Страна выпуска</option>
                    @foreach($country as $key => $value)
                        <option value="{{$value->id}}">{{$value->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select class="mdb-select md-form">
                    {{--@todo Решить как выводить студии--}}
                    <option value="" disabled selected>Студия выпустившая аниме</option>
                    {{-- @foreach($category as $key => $value)
                         <option
                             value="{{$value->id}}"
                             @foreach($animePost->getCategory as $categoryAnime)
                             @if($value->id === $categoryAnime->id)
                             selected
                             @endif
                             @endforeach
                         >{{$value->title}}</option>
                     @endforeach--}}
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <select name="tip" class="mdb-select md-form">
                    <option value="" disabled selected>Тип аниме</option>
                    @foreach($tip as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="count_series" name="count_series" class="form-control"
                           value="">
                    <label for="count_series" class="title-info">Количество серий</label>
                </div>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="duration" name="duration" class="form-control"
                           value="">
                    <label for="duration" class="title-info">Продолжительность</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="md-form">
                    <input type="date" id="aired_on" name="aired_on" class="form-control"
                           value="">
                    <label for="aired_on">Выберите дату начала показа</label>
                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                    <input type="date" id="released_on" class="form-control" name="released_on"
                           value="">
                    <label for="released_on">Выберите дату окончания показа</label>
                </div>
            </div>
        </div>
        {{--@todo Разобратся с преобразованием " в &quot--}}
        <select name="rating" class="mdb-select md-form">
            <option value="" disabled selected>Возрастное ограничение</option>
            @foreach($rating as $key => $value)
                <option value="{{$key}}">{!! html_entity_decode($value) !!}</option>
            @endforeach
        </select>
        <select name="released" class="mdb-select md-form">
            <option value="" disabled selected>Завершен</option>
            <option value="ongoing">Онгоинг</option>
            <option value="released">Завершен</option>
        </select>
        <div class="md-form">
            <input type="text" id="video" name="video" class="form-control"
                   value="">
            <label for="video" class="title-info">Ссылка на плеер</label>
        </div>
        <div class="form-check">
            <input type="hidden" name="posted_at" value="0">
            <input type="checkbox" name="posted_at" class="form-check-input" id="posted_at"
                   value="1" checked>
            <label class="form-check-label" for="posted_at">Опубликовать на сайте</label>
        </div>
        @endsection
        @section('footer')
            <button class="btn btn-success btn-rounded" type="submit">Сохранить</button>
            <button class="btn btn-danger btn-rounded" type="button"
                    onclick="window.location='{{ route('admin.anime') }}'">Отменить
            </button>
    </form>
@endsection
