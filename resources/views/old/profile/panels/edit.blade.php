<div class="container">
    {{Form::open(['method'=>'patch', 'enctype'=>'multipart/form-data'])}}
    <div class="row">
        <div class="col-sm-12 md-form">
            {{ Form::input('text','name',(string) $profile->name, ['id'=>'name', 'class'=>'form-control']) }}
            {{ Form::label('name', 'Ваше имя',['class'=>'title-info']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 md-form">
            {{Form::input('email', 'email', (string)$profile->email, ['id'=>'email', 'class'=>'form-control', 'disabled'])}}
            {{ Form::label('email', 'Ваш e-mail',['class'=>'title-info']) }}
        </div>
        <div class="col-sm-3 form-check" style="white-space: nowrap;">
            {{--{{Form::input('hidden', 'allow_email', 0)}}--}}
            {{Form::checkbox('allow_email', 1, (string)$profile->allow_email , ['id'=>'materialChecked2', 'class'=>'form-check-input'])}}
            {{ Form::label('materialChecked2', 'Скрыть почту',['class'=>'form-check-label title-info']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{Form::select('country_id', (array)$countryArray, (string)$profile->country_id, ['id'=>'country', 'class'=>'mdb-select md-form colorful-select dropdown-info'])}}
            {{ Form::label('country', 'Страна проживания',['class'=>'title-info mdb-main-label']) }}
        </div>
    </div>
    {{--<div class="row">
        <div class="col-sm-12">
            <select id="time_zone" name="time_zone" class="mdb-select md-form colorful-select dropdown-primary">
                @foreach($tz as $timeZoneEN => $timeZoneRU)
                    <option value="{{ $timeZoneEN }}"
                            @if($profile->time_zone==$timeZoneEN) selected @endif>{{ $timeZoneRU }}
                    </option>
                @endforeach
            </select>
            <label for="time_zone" class="title-info mdb-main-label">Часовой пояс</label>
        </div>
    </div>--}}
    <div class="row">
        <div class="col-sm-9 md-form file-field">
            <div class="btn btn-primary btn-sm float-left">
                <span>Загрузите аватар</span>
                {{Form::file('photo')}}
                {{Form::file('photo', ['id'=>'photo'])}}
            </div>
            <div class="file-path-wrapper">
                {{Form::input('text', null, null, ['class'=>'file-path', 'placeholder'=>'Загрузите аватар'])}}
            </div>
        </div>
        <div class="col-sm-3 form-check" style="white-space: nowrap;">
            {{Form::checkbox('del_foto', 1, null, ['id'=>'del_foto', 'class'=>'form-check-input'])}}
            {{ Form::label('del_foto', 'Удалить аватар',['class'=>'form-check-label title-info']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 md-form">
            {{Form::textarea('signature', old((string)$profile->signature), ['id'=>'signature', 'rows'=>'3', 'class'=>'md-textarea form-control'])}}
            {{ Form::label('signature', 'Подпись',['class'=>'title-info']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 md-form">
            {{Form::password('old_password', ['class' => 'form-control','id'=>'old_password'])}}
            {{ Form::label('old_password', 'Старый пароль',['class'=>'title-info']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 md-form">
            {{Form::password('new_password', ['class' => 'form-control','id'=>'new_password'])}}
            {{ Form::label('new_password', 'Новый пароль',['class'=>'title-info']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 md-form">
            {{Form::password('confirm_password', ['class' => 'form-control','id'=>'confirm_password'])}}
            {{ Form::label('confirm_password', 'Повторите новый пароль',['class'=>'title-info']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                {{Form::submit('Сохранить', ['class'=>'btn btn-success', 'id'=>'submit'])}}
            </div>
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                {{Form::button('Отменить', ['onclick'=>'window.location="'.route('profile', $profile->login).'"', 'class'=>'btn btn-danger', 'data-dismiss'=>'modal'])}}
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>

