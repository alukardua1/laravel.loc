@foreach($carouselAnime as $animePost)
    <div class="row">
        <div class="col-md-3">
            <div class="card-img">
                <img src="{{ isset($animePost->image) ? asset('storage/'. $animePost->image) : asset('images/no_poster.jpg')}}"
                    class="img-fluid" alt="{{ $animePost->title }}"/>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card-title">
                <h3 class="font-weight-bold">
                    {{ $animePost->title }}
                    {{ isset($animePostOne->romaji) ? ' / ' .$animePostOne->romaji: '' }}
                </h3>
            </div>
            <div class="card-text">
                <p class="font-weight-bold">
                    @foreach($animePost->getCategory as $category)
                        @if ($loop->last) {{ $category['title'] }} @else
                            {{ $category['title'] }} /
                        @endif
                    @endforeach
                </p>
                <p class="text-muted">{{ Str::limit($animePost->content, 300) }}</p>
                <a class="font-weight-bold" href="{{ route('anime', $post->url) }}">
                    Смотреть
                    <i class="fas fa-angle-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach

