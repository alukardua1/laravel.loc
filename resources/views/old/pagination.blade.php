@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-circle pg-red justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="btn btn-danger btn-rounded">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="btn btn-outline-danger btn-rounded waves-effect"
                       href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item"><a class="page-link disabled">1</a></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active disabled">
                                <span class="btn btn-danger btn-rounded">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="btn btn-outline-danger btn-rounded waves-effect"
                                   href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline-danger btn-rounded waves-effect">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="btn btn-danger btn-rounded">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
