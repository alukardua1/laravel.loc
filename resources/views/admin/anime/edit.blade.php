@extends('admin.layouts.dashboard')
@section('title', 'Редактировани аниме '.$animePost->title)
@section('content')
    <form method="POST" action="{{ route('admin.anime.update', $animePost->url) }}"
          enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        {{--@todo не забыть сменить урл--}}
        <label>ID={{$animePost->id}}, автор публикации:<a href="#"> {{$animePost->getUsers->login}}</a></label>
        <div class="md-form">
            <label for="title" class="title-info">Заголовок</label>
            <input type="text" id="title" name="title" class="form-control" value="{{$animePost->title}}">
        </div>
        <div class="row">
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="japanese" name="japanese" class="form-control"
                           value="{{$animePost->japanese}}">
                    <label for="japanese" class="title-info">Японское название</label>
                </div>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="english" name="english" class="form-control"
                           value="{{$animePost->english}}">
                    <label for="english" class="title-info">Английское название</label>
                </div>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="romaji" name="romaji" class="form-control"
                           value="{{$animePost->romaji}}">
                    <label for="romaji" class="title-info">Название (ромадзи)</label>
                </div>
            </div>
        </div>
        <select name="genre[]" class="mdb-select md-form" multiple>
            <option value="" disabled selected>Выберите категорию</option>
            @foreach($category as $key => $value)
                <option
                    value="{{$value->id}}"
                    @foreach($animePost->getCategory as $categoryAnime)
                    @if($value->id === $categoryAnime->id)
                    selected
                    @endif
                    @endforeach
                >{{$value->title}}</option>
            @endforeach
        </select>
        <div class="md-form">
            <textarea id="content" name="content" class="md-textarea form-control"
                      rows="10">{{$animePost->content}}</textarea>
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
                    <input type="text" id="wa_id" name="wa_id" class="form-control" value="{{$animePost->wa_id}}">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="shikimori_id" class="title-info">ID Shikimori</label>
                    <input type="text" id="shikimori_id" name="shikimori_id" class="form-control"
                           value="{{$animePost->shikimori_id}}">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="kp_id" class="title-info">ID Кинопоиск</label>
                    <input type="text" id="kp_id" name="kp_id" class="form-control" value="{{$animePost->kp_id}}">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="mal_id" class="title-info">ID MaiAnimeList</label>
                    <input type="text" id="mal_id" name="mal_id" class="form-control" value="{{$animePost->mal_id}}">
                </div>
            </div>
            <div class="col-2">
                <div class="md-form">
                    <label for="anidb_id" class="title-info">ID AniDB</label>
                    <input type="text" id="anidb_id" name="anidb_id" class="form-control"
                           value="{{$animePost->anidb_id}}">
                </div>
            </div>
            <div class="col-2">

            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="md-form">
                    <input type="time" id="delivery_time" name="delivery_time" class="form-control"
                           value="{{$animePost->delivery_time}}">
                    <label for="delivery_time" class="title-info">Время показа</label>
                </div>
            </div>
            <div class="col-9">
                <div class="md-form">
                    <input type="text" id="tv_canal" name="tv_canal" class="form-control"
                           value="{{$animePost->tv_canal}}">
                    <label for="tv_canal" class="title-info">Телеканал</label>
                </div>
            </div>
        </div>
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
        <div class="row">
            <div class="col-4">
                <select name="tip" class="mdb-select md-form">
                    <option value="" disabled selected>Тип аниме</option>
                    @foreach($tip as $key => $value)
                        <option value="{{$key}}"
                                @if($key === $animePost->tip)
                                selected
                            @endif
                        >{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="count_series" name="count_series" class="form-control"
                           value="{{$animePost->count_series}}">
                    <label for="count_series" class="title-info">Количество серий</label>
                </div>
            </div>
            <div class="col-4">
                <div class="md-form">
                    <input type="text" id="duration" name="duration" class="form-control"
                           value="{{$animePost->duration}}">
                    <label for="duration" class="title-info">Продолжительность</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="md-form">
                    <input type="date" id="aired_on" name="aired_on" class="form-control"
                           value="{{$animePost->aired_on}}">
                    <label for="aired_on">Выберите дату начала показа</label>
                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                    <input type="date" id="released_on" class="form-control" name="released_on"
                           value="{{$animePost->released_on}}">
                    <label for="released_on">Выберите дату окончания показа</label>
                </div>
            </div>
        </div>
{{--@todo Разобратся с преобразованием " в &quot--}}
        <select name="rating" class="mdb-select md-form">
            <option value="" disabled selected>Возрастное ограничение</option>
            @foreach($rating as $key => $value)
                <option value="{{$key}}"
                        @if($key === $animePost->rating)
                        selected
                    @endif
                >{!! html_entity_decode($value) !!}</option>
            @endforeach
        </select>
        @endsection
        @section('footer')
            <button class="btn btn-success btn-rounded" type="submit">Save</button>
    </form>
@endsection
