<div class="media d-block d-md-flex mt-4">
    <img class="card-img-64 rounded z-depth-1 d-flex mx-auto mb-3"
         src="{{ isset($comment->getUser->photo ) ? asset('storage/avatars/'. $comment->getUser->photo) :
                                    asset('theme/'.$theme.'/images/no_avatar.png' )}}" alt="{{ $comment->getUser->login }}">
    <div class="media-body text-center text-md-left ml-md-3 ml-0">
        <input type="hidden" id="comment_{{ $comment->id }}" value="{{ $comment->id }}">
        <p class="font-weight-bold my-0">
            {{ $comment->getUser->login }}
            <a href="" class="pull-right ml-1">
                <i class="fas fa-reply"></i>
            </a>
        </p>
        {{ $comment->content }}
        @each($theme.'.comments.show', $comment->children, 'comment')
    </div>
</div>
