@extends('layouts.dashboard')
@section('main')

	<div class="tile">

		@if ($list->count())
			@foreach ($list as $notification)
				<div class="card my-3">
					<div class="card-header">
						خطاب به : <span class="text-info"> {{$notification->target == 'organ' ? 'موسسات' : 'متصدیان'}} </span>
					</div>
					<div class="card-body">
						<blockquote class="blockquote mb-0">
							<p> {{$notification->body}} </p>
							<footer class="blockquote-footer"> {{human_date($notification->created_at)}} </footer>
						</blockquote>
					</div>
					<div class="card-footer text-left">
						<a href="#edit-body" data-toggle="collapse" class="btn btn-outline-success ml-2">
							<i class="fa fa-edit ml-1"></i> ویرایش متن
						</a>
						<form class="d-inline" action="{{url("notifications/{$notification->id}")}}" method="post" id="delete-notification-{{$notification->id}}">
							@method('DELETE')
							@csrf
							<button type="button" class="btn btn-outline-danger delete" data-toggle="popover" data-content="با لغو اطلاع رسانی، پیغام فرستاده شده از داشبرد کاربران حذف خواهد شد." data-trigger="hover" data-placement="top" data-target="delete-notification-{{$notification->id}}">
								<i class="fa fa-times ml-1"></i> لغو اطلاع رسانی
							</button>
						</form>
						<div id="edit-body" class="collapse">
							<hr>
							<form class="row align-items-center" action="{{url("notifications/$notification->id")}}" method="post">
								@csrf
								@method('PUT')
								<div class="col-md-11 form-group">
									<textarea name="body" rows="3" class="form-control">{{$notification->body}}</textarea>
								</div>
								<div class="col-md-1">
									<button type="submit" class="btn btn-primary btn-block"> ذخیره </button>
								</div>
							</form>
						</div>
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
