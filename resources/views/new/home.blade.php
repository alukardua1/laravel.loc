@extends('new.layouts.app')
@section('title', config('appSecondConfig.nameSite'))
@section('description', config('appSecondConfig.descriptionSite'))
@section('content')
    @foreach($animePost as $anime)
        <div class="col-md-10 col-lg-9 col-xl-6 mb-r mb-3">
            <div class="card">
                <div class="card-body mb-3">
                    <div class="card-title grey lighten-4 py-2 mb-4 text-center font-weight-bold">
                        {{$anime->title}}
                    </div>
                    <div class="media d-block d-md-flex">
                        <img class="d-flex poster mb-md-0 mb-3 mx-auto"
                             src="{{ isset($anime->poster) ?
                                     asset('storage/'. $anime->poster): asset('theme/'.$theme.'/images/no_poster.jpg')}}"
                             alt="{{$anime->title}}">
                        <div class="card-text media-body text-center text-md-left ml-md-3 ml-0">
                            <p class="font-weight mb-3 font-italic">в озвучке:
                                @foreach($anime->getTranslate as $translate)
                                    @if ($loop->last) {{ $translate->title }} @else
                                        {{ $translate->title }},
                                    @endif
                                @endforeach
                            </p>
                            <p class="font-weight mb-3">жанр:
                                @foreach($anime->getCategory as $category)
                                    @if ($loop->last) {{ $category->title }} @else
                                        {{ $category->title }} /
                                    @endif
                                @endforeach</p>
                            <p>{!! Str::limit($anime->content, 200) !!}</p>
                            <a href="{{ route('anime', $anime->id.'-'.$anime->url) }}" type="button"
                               class="btn btn-outline-success btn-md">Смотреть...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if($animePost->total() > $animePost->count())
        {{ $animePost->links() }}
    @endif
@endsection
