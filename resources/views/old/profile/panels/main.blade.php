<div class="container">
    <div class="row" style="white-space: nowrap;">
        <div class="col-sm-10"><span class="title-info"><i class="far fa-user"></i> Логин </span></div>
        <div class="col-sm-2"><span class="float-right font-weight-bold">{{ $profile->login }}</span></div>
    </div>
    <div class="row" style="white-space: nowrap;">
        <div class="col-sm-10"><span class="title-info"><i class="far fa-user"></i> Имя </span></div>
        <div class="col-sm-2"><span class="float-right">{{ $profile->name }}</span>
        </div>
    </div>
    <div class="row" style="white-space: nowrap;">
        <div class="col-sm-10"><span class="title-info"><i class="fas fa-globe"></i> Страна </span></div>
        <div class="col-sm-2"><span class="float-right">{{ $profile->getCountry->title }}</span></div>
    </div>
    @if(($profile->group_id == 1)or(Auth::user()))
        <div class="row" style="white-space: nowrap;">
            <div class="col-sm-10"><span class="title-info"><i class="fas fa-globe"></i> Дата рождения (доступно только администраторам)</span></div>
            <div class="col-sm-2"><span class="float-right">{{ $profile->date_of_birth }}</span></div>
        </div>
    @endif
    <div class="row" style="white-space: nowrap;">
        <div class="col-sm-10"><span class="title-info"><i class="far fa-calendar-alt"></i> Зарегистрирован </span>
        </div>
        <div class="col-sm-2">
            <span class="float-right">{{ $profile->register }}</span></div>
    </div>
    <div class="row" style="white-space: nowrap;">
        <div class="col-sm-10"><span class="title-info"><i class="far fa-calendar-alt"></i> Последняя активность </span>
        </div>
        <div class="col-sm-2"><span class="float-right">{{ $profile->last_login_formated }}</span></div>
    </div>
    <div class="row" style="white-space: nowrap;">
        <div class="col-sm-10"><span class="title-info"><i class="fas fa-users"></i> Группа </span></div>
        <div class="col-sm-2">
            <span class="float-right">{!! $profile->group !!}</span>
        </div>
    </div>
    @if(empty($profile->allow_email))
        <div class="row" style="white-space: nowrap;">
            <div class="col-sm-10"><span class="title-info"><i class="fas fa-at"></i> Почта </span></div>
            <div class="col-sm-2"><span class="float-right"><a href="mailto:{{ $profile->email }}">Почта</a></span>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12"><span class="title-info"><i class="fas fa-signature"></i> Подпись</span></div>
        <div class="row" style="word-break: break-all;">
            <div class="col-sm-12">{{ $profile->signature }}</div>
        </div>
    </div>
</div>
