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
            <textarea id="content" name="content" class="md-textarea form-control" rows="10">{{$animePost->content}}</textarea>
        </div>

@endsection
@section('footer')
    <button class="btn btn-success btn-rounded" type="submit">Save</button>
    </form>
@endsection
