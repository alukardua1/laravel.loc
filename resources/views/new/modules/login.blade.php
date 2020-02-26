@guest
    <a class="nav-link" data-toggle="modal" data-target="#auth">Вход / Регистрация</a>
    @include($theme.'.modules.auth')
@else
    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        <img src="{{ !empty(Auth::user()->photo) ? asset('storage/avatars/'. Auth::user()->photo) : asset('theme/'.$theme.'/images/no_avatar.png' ) }}"
             class="rounded-circle z-depth-0"
             alt="{{Auth::user()->login}}">
        {{Auth::user()->login}}</a>
    <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink">
        @if(Auth::user()->group_id == 1)
            <a class="dropdown-item" href="{!! route('admin') !!}" target="_blank">Админпанель</a>
        @endif
        <a class="dropdown-item" href="{{route('profile', Auth::user()->login)}}">Профиль</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endguest