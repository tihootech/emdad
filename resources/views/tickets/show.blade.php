@extends('layouts.dashboard')
@section('title') {{$ticket->title}} @endsection
@section('main')

	<div class="tile text-left">

		<a href="{{url("ticket/message/$ticket->uid")}}" class="btn btn-outline-primary mx-1">
			<i class="fa fa-pencil ml-1"></i> درج پاسخ
		</a>

		@if ($ticket->status != 'closed')
			<form class="d-inline" action="{{url("ticket/close/$ticket->uid")}}" method="post">
				@csrf
				<button type="submit" class="btn btn-outline-danger mx-1">
					<i class="fa fa-times ml-1"></i> بستن نامه
				</button>
			</form>
		@endif

	</div>

	<div class="tile">

		@master
			@if ($ticket->notification_history)
				<div class="alert alert-info my-3">
					<i class="fa fa-info-circle ml-1"></i>
					این نامه مربوط به اعلامیه
					<a href="{{url("notifications/history/manage/{$ticket->notification_history->id}")}}" class="mx-1 text-underlined">
						{{short($ticket->notification_history->body)}}
					</a>
					میباشد.
				</div>
			@endif
		@endmaster

		@if ($ticket->status == 'closed')
			<div class="alert alert-warning my-3">
				<i class="fa fa-warning ml-1"></i>
				این نامه بسته شده است.
				برای باز کردن آن کافیست پاسخ جدید درج کنید.
			</div>
		@endif

		<div class="container">
			@foreach ($ticket->messages as $message)

				<div class="card my-3 @if($message->author_is_master()) text-light bg-dark @else bg-light @endif">
					<div class="card-header">
						<h5> نویسنده : {{$message->author()}} </h5>
					</div>
					<div class="card-body">
						<blockquote class="blockquote mb-0">
							<small> {{$message->body}} </small>
							<hr>
							<footer class="blockquote-footer @if($message->author_is_master()) text-light @endif">
								{{human_date($message->created_at)}}
								ساعت
								<span class="mx-1"> {{$message->created_at->format('H:i')}} </span>
							</footer>
						</blockquote>
					</div>
					<div class="card-footer text-left">
						@if ($message->file)
							<a class="btn btn-sm @if($message->author_is_master()) btn-outline-light @else btn-outline-dark @endif"
								href="{{asset($message->file)}}" download>
								<i class="fa fa-download ml-1"></i>
								دانلود فایل ضمیمه
							</a>
						@else
							<em> بدون فایل ضمیمه </em>
						@endif
					</div>
				</div>

			@endforeach

			@if ($ticket->notification_history)
				<div class="card bg-info text-light">
					<div class="card-header">
						<h5> متن اعلامیه </h5>
					</div>
					<div class="card-body">
						{{$ticket->notification_history->body}}
					</div>
				</div>
			@endif

		</div>

	</div>
@endsection
