<?php // TODO: replace tihootech ?>
<header class="app-header">

    <a class="app-header__logo" href="{{url("/")}}"> <i class="fa fa-home"></i> </a>

    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        {{-- <li class="app-search">
            <input class="app-search__input" type="search" placeholder="جستجو">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li> --}}
        <!--Notification Menu-->
        <li class="dropdown">
            <a class="app-nav__item p-relative" href="#" data-toggle="dropdown">
                <i class="fa fa-bell fa-lg"></i>
                @if ($ncount = auth()->user()->fresh_notifications->count())
                    <span class="app-notification__number">{{$ncount}}</span>
                @endif
            </a>
            <ul class="app-notification dropdown-menu text-right">
                @if (auth()->user()->fresh_notifications->count())
                    @foreach (auth()->user()->fresh_notifications as $notification)
                        <li class="app-notification__item">
                            <a href="{{url("notifications")}}"> {{$notification->history ? short($notification->history->body) : '-'}} </a>
                        </li>
                    @endforeach
                @else
                    <li class="app-notification__title"> شما اعلامیه جدیدی ندارید. </li>
                @endif
                <li class="app-notification__footer"> <a href="{{url("notifications")}}"> مشاهده همه اعلامیه ها </a> </li>
            </ul>
        </li>
        <!--Ticket Menu-->
        <li class="dropdown">
            <a class="app-nav__item p-relative" href="#" data-toggle="dropdown">
                <i class="fa fa-envelope fa-lg"></i>
                @if ($tcount = auth()->user()->new_tickets()->count())
                    <span class="app-notification__number">{{$tcount}}</span>
                @endif
            </a>
            <ul class="app-notification dropdown-menu text-right">
                @if (auth()->user()->new_tickets()->count())
                    @foreach (auth()->user()->new_tickets() as $ticket)
                        <li class="app-notification__item">
                            <a href="{{url("ticket")}}"> {{$ticket->title}} </a>
                        </li>
                    @endforeach
                @else
                    <li class="app-notification__title"> شما نامه جدیدی ندارید. </li>
                @endif
                <li class="app-notification__footer"> <a href="{{url("ticket")}}"> مشاهده همه نامه ها </a> </li>
            </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu text-right">
                <li><a class="dropdown-item" href="{{url("acc")}}"><i class="fa fa-user fa-lg"></i> مدیریت حساب کاربری </a></li>
                <li>
                    <a class="dropdown-item pointer" onclick="document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out ml-1"></i> خروج
                    </a>
                    <form id="logout-form" action="{{url("logout")}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{url("home")}}" class="app-nav__item"> <i class="fa fa-dashboard"></i> </a>
        </li>

        <li class="nav-item">
            <a href="javascript:void" class="app-nav__item" onclick="window.history.back()"> <i class="fa fa-arrow-left"></i> </a>
        </li>
    </ul>
</header>
