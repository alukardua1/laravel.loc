@extends($theme.'/layouts.app')
@section('title',  $staticPage->title ?? config('app.name'))
@section('description', $categories->description ?? env('APP_DESCRIPTION_SITE'))
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$staticPage->title}}</h5>
            <p class="card-text">{{$staticPage->description}}</p>
        </div>
    </div>
@endsection
