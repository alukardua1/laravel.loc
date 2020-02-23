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
            <form action="" class="md-form">
                <input type="hidden">
                <section>
                    <textarea id="comments" class="md-textarea form-control" rows="3"></textarea>
                    <button type="button" class="btn btn-danger">Отправить</button>
                </section>
            </form>
        @endif
    </div>
</div>
