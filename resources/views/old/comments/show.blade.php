<div class="media d-block d-md-flex mt-4">
    <img class="card-img-64 rounded z-depth-1 d-flex mx-auto mb-3"
         src="{{ isset($comment->getUser->photo ) ? asset('storage/avatars/'. $comment->getUser->photo) :
                                    asset('theme/'.$theme.'/images/no_avatar.png' )}}"
         alt="{{ $comment->getUser->login }}">
    <div class="media-body text-center text-md-left ml-md-3 ml-0">
        <input type="hidden" id="comment_{{ $comment->id }}" value="{{ $comment->id }}">
        <input type="hidden" id="user_{{$comment->getUser->id}}" value="{{$comment->getUser->id}}">
        <p class="font-weight-bold mb-3">
            {{ $comment->getUser->login }}
            @if(Auth::user())
                @if(Auth::user()->id <> $comment->getUser->id)
                    <a onclick='document.querySelector("textarea[name=content]").value="{{$comment->getUser->login}}, ",
                            document.querySelector("input[name=parent_comment_id]").value="{{ $comment->id }}"'
                       class="float-right ml-1"><i class="fas fa-reply"></i></a>
                @endif
                @if((Auth::user()->id == $comment->getUser->id) or (Auth::user()->group_id == 1))
                    <a href="{{route('deleteComment', $comment->id)}}" class="float-right ml-1">
                        <i class="far fa-trash-alt"></i></a>
                @endif
            @endif
        </p>
        <p class="note note-light">{{$comment->content}}</p>
        @if($comment->getUser->signature)
            <p class="note note-info">{{$comment->getUser->signature}}</p>
        @endif
        @each($theme.'.comments.show', $comment->children, 'comment')
    </div>
</div>