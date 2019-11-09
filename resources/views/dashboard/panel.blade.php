@master
	@php
		$hrefs = ['owners/operator', 'owners/organ'];
	@endphp
	<li class="treeview @if(expanded($hrefs)) is-expanded @endif">
		<a class="app-menu__item" href="#" data-toggle="treeview">
			<i class="app-menu__icon fa fa-users"></i>
			<span class="app-menu__label"> مدیریت کاربران </span>
			<i class="treeview-indicator fa fa-angle-left"></i>
		</a>
		<ul class="treeview-menu">
			<li>
				<a class="treeview-item @if(active($hrefs[0])) active @endif" href="{{url($hrefs[0])}}">
					<i class="icon fa fa-user-secret"></i> مدیریت متصدیان
				</a>
			</li>
			<li>
				<a class="treeview-item @if(active($hrefs[1])) active @endif" href="{{url($hrefs[1])}}">
					<i class="icon fa fa-bank"></i> مدیریت موسسات
				</a>
			</li>
		</ul>
	</li>

@endmaster


@operator
	@php
		$hrefs = ['madadju/create', 'madadju'];
	@endphp
	<li class="treeview @if(expanded($hrefs)) is-expanded @endif">
		<a class="app-menu__item" href="#" data-toggle="treeview">
			<i class="app-menu__icon fa fa-male"></i>
			<span class="app-menu__label"> مدیریت مددجویان </span>
			<i class="treeview-indicator fa fa-angle-left"></i>
		</a>
		<ul class="treeview-menu">
			<li>
				<a class="treeview-item @if(active($hrefs[0])) active @endif" href="{{url($hrefs[0])}}">
					<i class="icon fa fa-user-plus"></i> تعریف مددجو جدید
				</a>
			</li>
			<li>
				<a class="treeview-item @if(active($hrefs[1])) active @endif" href="{{url($hrefs[1])}}">
					<i class="icon fa fa-list"></i> لیست مددجویان
				</a>
			</li>
		</ul>
	</li>
@endoperator

<li>
	<a class="app-menu__item @if(active('introduce')) active @endif" href="{{url("introduce")}}">
		<i class="app-menu__icon fa fa-list"></i>
		<span class="app-menu__label"> لیست معرفی شدگان </span>
	</a>
</li>

@master

	<li>
		<a class="app-menu__item @if(active('notifications/create')) active @endif" href="{{url("notifications/create")}}">
			<i class="app-menu__icon fa fa-bullhorn"></i>
			<span class="app-menu__label"> اطلاع رسانی </span>
		</a>
	</li>

@endmaster
