@php
    $hrefs = ['layouts'];
@endphp
<li class="treeview @if(expanded($hrefs)) is-expanded @endif">
    <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-globe"></i>
        <span class="app-menu__label"> مدیریت سایت </span>
        <i class="treeview-indicator fa fa-angle-left"></i>
    </a>
    <ul class="treeview-menu">
        <li>
            <a class="treeview-item @if(active($hrefs[0])) active @endif" href="{{url($hrefs[0])}}">
                <i class="icon fa fa-cogs"></i> مدیریت کلی
            </a>
        </li>
    </ul>
</li>
