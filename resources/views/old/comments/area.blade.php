<div class="row">
    <div class="col-md-12">
        <h3 class="font-weight-bold mb-3">
            Комментариев {{ $commentsCount }}</h3>
    </div>
    <div class="col-md-12">
        <section class="text-center text-lg-left dark-grey-text">
            @each($theme.'.comments.show', $comments, 'comment')
        </section>
        @if(Auth::user())
            <form action="{{route('addComment')}}" method="post" class="md-form">
                @csrf
                <input type="hidden">
                <section>
                    <label for="comments">Комментарий</label>
                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" id="anime_id" name="anime_id" value="{{$animePost->id}}">
                    <input type="hidden" id="parent_comment_id" name="parent_comment_id" value="0">
                    <textarea name="content" id="comments" class="md-textarea form-control" rows="3"></textarea>
                    <button type="submit" class="btn btn-danger">Отправить</button>
                </section>
            </form>
        @endif
    </div>
</div>
