@extends($theme.'/layouts.app')
@section('title',  $categories->title ?? config('appSecondConfig.nameSite'))
@section('description', $categories->description ?? config('appSecondConfig.descriptionSite'))
@section('content')
    @foreach($animePost as $post)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 col-xl-4">
                        <div class="card-img">
                            <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                                <div class="product-2">
                                    <img class="img-fluid wow fadeInUp" src="{{ isset($post->poster) ?
                                     asset('storage/'. $post->poster): asset('theme/'.$theme.'/images/no_poster.jpg')}}"
                                         alt="{{ $post->title }}">
                                    <span class="sale-2 z-depth-1">{{ $tipFullRu[$post->tip] }}</span>
                                </div>
                                <a>
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-8">
                        <div class="card-title">
                            <h3 class="font-weight-bold mb-3"><a href="{{ route('anime', $post->url) }}"><strong>
                                        {{ $post->title }}
                                    </strong></a></h3>
                        </div>
                        <div class="card-text">
                            <p class="blog-post-meta">
                                {{ Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }} |
                                @foreach($post->getCategory as $category)
                                    @if ($loop->last) {{ $category->title }} @else
                                        {{ $category->title }} /
                                    @endif
                                @endforeach
                            </p>
                            <p class="dark-grey-text">{!! Str::limit($post->content, 300) !!}</p>
                            <a href="{{ route('anime', $post->url) }}" class="btn btn-success">Смотреть...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!--Pagination-->
    @if($animePost->total() > $animePost->count())
        {{ $animePost->links($theme.'/pagination') }}
    @endif
    <!--Pagination-->
@endsection
