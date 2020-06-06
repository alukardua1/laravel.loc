@guest
    <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <div class="modal-content">
                <div class="modal-c-tabs">
                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#login" role="tab">
                                <i class="fas fa-user mr-1"></i>
                                Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#register" role="tab">
                                <i class="fas fa-user-plus mr-1"></i>
                                Регистрация</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in show active" id="login" role="tabpanel">
                            <form method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="modal-body mb-1">
                                    {{--<div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input type="text" name="login" id="email" class="form-control form-control-sm"
                                               value="{{ old('login') }}">
                                        <label data-error="wrong" data-success="right" for="login">Логин</label>
                                    </div>--}}

                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input type="email" name="email" id="email" class="form-control form-control-sm"
                                               value="{{ old('email') }}">
                                        <label data-error="wrong" data-success="right" for="email">Email</label>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="password" name="password" id="password"
                                               class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="password">пароль</label>
                                    </div>

                                    <div class="md-form form-sm mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Запомнить</label>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="options text-center text-md-right mt-1">
                                        <p>Востановить <a href="{{ route('password.request') }}" class="blue-text">пароль?</a>
                                        </p>
                                    </div>
                                    <button class="btn btn-outline-info waves-effect ml-auto">Войти
                                        <i class="fas fa-sign-in ml-1"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input type="text" id="login"
                                               class="form-control form-control-sm"
                                               name="login" value="{{ old('login') }}" required autocomplete="login">
                                        <label data-error="wrong" data-success="right" for="login">Логин</label>
                                    </div>

                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input type="email" id="email"
                                               class="form-control form-control-sm"
                                               name="email" value="{{ old('email') }}" required autocomplete="email">
                                        <label data-error="wrong" data-success="right" for="email">Почта</label>
                                    </div>

                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="password" id="password"
                                               class="form-control form-control-sm"
                                               name="password" required autocomplete="new-password">
                                        <label data-error="wrong" data-success="right" for="password">Пароль</label>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="password" id="password_confirmation"
                                               class="form-control form-control-sm"
                                               name="password_confirmation" required autocomplete="new-password">
                                        <label data-error="wrong" data-success="right" for="password_confirmation">Повторите
                                            пароль</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-info waves-effect ml-auto">Регистрация
                                        <i class="fas fa-sign-in ml-1"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="" class="btn waves-effect ml-auto btn-rounded my-3" data-toggle="modal" data-target="#modalLRForm">
            Вход / Регистрация</a>
    </div>

    {{--            --}}{{--<p>или войдите через:</p>--}}
    {{--            <a href="{facebook_url}" target="_blank" type="button" class="light-blue-text mx-2">--}}
    {{--                <i class="fab fa-facebook-f"></i>--}}
    {{--            </a>--}}
    {{--            <a href="{vk_url}" target="_blank" type="button" class="light-blue-text mx-2">--}}
    {{--                <i class="fab fa-vk"></i>--}}
    {{--            </a>--}}
    {{--        </form>--}}
    {{--    </div>--}}
@else
    <div class="dropdown">
        <button type="button" class="btn dropdown-toggle chip chip-md waves-effect waves-light" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-fluid rounded-circle"
                 src="{{ !empty(Auth::user()->photo) ? asset('storage/avatars/'. Auth::user()->photo) : asset('theme/'.$theme.'/images/no_avatar.png' ) }}"
                 alt="{{ Auth::user()->login }}">
            {{ Auth::user()->login }}
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @if(Auth::user()->group_id === 1)
                <a class="dropdown-item" href="{!! route('admin') !!}" target="_blank">Админпанель</a>
            @endif
            <a class="dropdown-item" href="{!! route('profile', Auth::user()->login) !!}">Мой профиль</a>
            {{--<a class="dropdown-item" href="{{ route('favorite') }}">Закладки <span
                    class="badge badge-info">--}}{{--{{$favoritesCount}}--}}{{--</span></a>--}}
            <a class="dropdown-item" href="{pm-link}">Сообщения <span class="badge badge-primary">{new-pm}</span> из
                <span class="badge badge-info">{all-pm}</span></a>
            <a class="dropdown-item" href="/feedback.html"> Обратная связь</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
@endguest
