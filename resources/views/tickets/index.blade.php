@extends('layouts.dashboard')
@section('title') لیست نامه ها @endsection
@section('main')

	<div class="tile">
		@master
			<div class="text-center">
				<a href="{{url("ticket?status=all")}}" class="mx-1 btn @if($status == 'all') btn-primary @else btn-outline-primary @endif">
					<i class="fa fa-list ml-1"></i>
					همه نامه ها
				</a>
				<a href="{{url("ticket?status=open")}}" class="mx-1 btn @if($status == 'open') btn-primary @else btn-outline-primary @endif">
					<i class="fa fa-hourglass-2 ml-1"></i>
					نامه های باز
				</a>
				<a href="{{url("ticket?status=answered")}}" class="mx-1 btn @if($status == 'answered') btn-primary @else btn-outline-primary @endif">
					<i class="fa fa-check ml-1"></i>
					نامه های پاسخ داده شده
				</a>
				<a href="{{url("ticket?status=closed")}}" class="mx-1 btn @if($status == 'closed') btn-primary @else btn-outline-primary @endif">
					<i class="fa fa-times ml-1"></i>
					نامه های بسته شده
				</a>
			</div>
		@else
			<div class="text-left">
				<a href="{{url("ticket/create")}}" class="btn btn-outline-primary">
					<i class="fa fa-plus ml-1"></i>
					ایجاد نامه جدید
				</a>
			</div>
		@endmaster
	</div>

	<div class="tile">

		@if ($tickets->count())
			<table class="table table-bordered table-hover table-striped table-responsive-lg">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col"> عنوان </th>
						@master
							<th scope="col">کاربر</th>
							<th scope="col">نوع کاربر</th>
						@endmaster
						<th scope="col"> وضعیت </th>
						<th scope="col"> اولویت </th>
						<th scope="col"> نوع نامه </th>
						<th scope="col"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tickets as $i => $ticket)
						<tr>
							<th scope="row"> {{$i+1}} </th>
							<td> {{$ticket->title}} </td>
							@master
								<td> {{ isset($ticket->user->owner) ? $ticket->user->owner->title() : 'Database Error' }} </td>
								<td> {{ persian($ticket->user->owner_type ?? 'Database Error') }} </td>
							@endmaster
							<td>
								<span class="badge badge-lg badge-{{$ticket->status_color()}}"> {{$ticket->persian_status()}} </span>
							</td>
							<td>
								<span class="badge badge-lg badge-{{$ticket->priority_color()}}"> {{$ticket->persian_priority()}} </span>
							</td>
							<td>
								<span class="badge badge-lg badge-{{$ticket->type_color()}}"> {{$ticket->persian_type()}} </span>
							</td>
							<td>
								<a href="{{url("ticket/$ticket->uid")}}" class="btn btn-outline-primary">
									<i class="fa fa-eye ml-1"></i>
									مشاهده
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{$tickets->links()}}
		@else
			<div class="alert alert-warning">
				نامهی یافت نشد.
			</div>
		@endif

	</div>
@endsection
