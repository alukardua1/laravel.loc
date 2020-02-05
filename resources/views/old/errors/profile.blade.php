@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $errorTxt)
            <div>
                {{ $errorTxt }}.
            </div>
        @endforeach
    </div>
@endif
