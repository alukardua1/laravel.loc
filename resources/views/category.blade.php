<!-- Modal -->
<div class="modal fade left" id="genre" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-left" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4"><h5
                    class="modal-title" id="exampleModalPreviewLabel">Жанры</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group my-4">
                    @foreach($categoryAll as  $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('category', $category->url) }}">
                                <p class="mb-0">
                                    {{ $category->title }}
                                </p>
                            </a>
                            <span class="badge teal badge-pill font-small float-right">
                                {{ $category->get_anime_count }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
