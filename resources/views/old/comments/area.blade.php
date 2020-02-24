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
                <section id="comment-text">
                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" id="anime_id" name="anime_id" value="{{$animePost->id}}">
                    <input type="hidden" id="parent_comment_id" name="parent_comment_id" value="0">
                    <label for="comments"></label>
                    <textarea name="content" id="comments" class="md-textarea form-control" rows="3"></textarea>
                    <button type="submit" class="btn btn-success">Отправить</button>
                    <button type="button" class="btn btn-danger" onclick='document.querySelector("textarea[name=content]").value="",
                            document.querySelector("input[name=parent_comment_id]").value="0"'>Отменить</button>
                </section>
            </form>
        @else
            <p class="note note-danger"><strong>Вы не авторизированы!</strong>
                <br>Для возможности комментировать пожалуста авторизируйтесь!!!</p>
        @endif
    </div>
</div>
