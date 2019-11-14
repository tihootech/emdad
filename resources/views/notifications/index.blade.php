@extends('layouts.dashboard')
@section('main')

	<div class="tile">

		@if ($list->count())
			@foreach ($list as $notification)
				<div class="card my-3">
					<div class="card-body">
						<blockquote class="blockquote mb-0">
							<small> {{$notification->history->body ?? 'Database Error'}} </small>
							<hr>
							<footer class="blockquote-footer"> {{human_date($notification->created_at)}} </footer>
						</blockquote>
					</div>
					<div class="card-footer text-left">
						<a href="{{url("ticket/create?nuid={$notification->history->uid}")}}" data-toggle="collapse" class="btn btn-outline-primary ml-2">
							<i class="fa fa-reply ml-1"></i> پاسخ دادن
						</a>
					</div>
				</div>
			@endforeach
		@else
			<div class="alert alert-warning">
				موردی یافت نشد.
			</div>
		@endif

		{{$list->links()}}
	</div>

@endsection
