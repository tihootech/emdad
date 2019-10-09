<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{asset('img/logo.png')}}" alt="Logo">
        <div>
            <p class="app-sidebar__user-name">{{auth()->user()->name}}</p>
            <p class="app-sidebar__user-designation"> داشبورد شما </p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item @if(active('home')) active @endif" href="{{url("home")}}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">داشبورد</span>
            </a>
        </li>

        @include('dashboard.panel')

    </ul>
</aside>
