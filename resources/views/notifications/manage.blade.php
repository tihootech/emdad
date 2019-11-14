@extends('layouts.dashboard')
@section('main')

	<div class="tile">
		<div class="card">
			<div class="card-header">
				خطاب به : <span class="text-info"> {{persian($history->target, true)}} </span>
			</div>
			<div class="card-body">
				<blockquote class="blockquote mb-0">
					<small> {{$history->body}} </small>
					<hr>
					<footer class="blockquote-footer"> {{human_date($history->created_at)}} </footer>
					<footer class="blockquote-footer">
						این اعلامیه برای
						<b class="text-info mx-1"> {{$history->send_to_count()}} </b>
						{{persian($history->target, false)}}
						ارسال شده است.
					</footer>
				</blockquote>
			</div>
			<div class="card-footer text-left">
				<a href="#edit-body" data-toggle="collapse" class="btn btn-outline-success ml-2">
					<i class="fa fa-edit ml-1"></i> ویرایش متن
				</a>
				<form class="d-inline" action="{{url("notifications/{$history->id}")}}" method="post" id="delete-notification-history">
					@method('DELETE')
					@csrf
					<button type="button" class="btn btn-outline-danger delete" data-toggle="popover" data-content="با لغو اطلاع رسانی، اعلامیه فرستاده شده از داشبرد تمام کاربران حذف خواهد شد." data-trigger="hover" data-placement="top" data-target="delete-notification-history">
						<i class="fa fa-times ml-1"></i> لغو اطلاع رسانی
					</button>
				</form>
				<div id="edit-body" class="collapse">
					<hr>
					<form class="row align-items-center" action="{{url("notifications/$history->id")}}" method="post">
						@csrf
						@method('PUT')
						<div class="col-md-11 form-group">
							<textarea name="body" rows="6" class="form-control">{{$history->body}}</textarea>
						</div>
						<div class="col-md-1">
							<button type="submit" class="btn btn-primary btn-block"> ذخیره </button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="tile">
		<table class="table table-bordered table-hover table-striped table-responsive-lg">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col"> {{persian($history->target, false)}} </th>
					<th scope="col"> خوانده شده </th>
					<th scope="col">  تاریخ خواندن </th>
					<th scope="col"> ساعت خواندن </th>
					<th scope="col"> عملیات </th>
				</tr>
			</thead>
			<tbody>
				@foreach ($notifications as $i => $notification)
					<tr>
						<th scope="row"> {{$i+1}} </th>
						<td> {{ isset($notification->user->owner) ? $notification->user->owner->title() : 'Database Error' }} </td>
						<td>
							@if ($notification->read)
								<i class="fa fa-check text-success"></i>
							@else
								<i class="fa fa-times text-muted"></i>
							@endif
						</td>
						<td> {{$notification->updated_at ? human_date($notification->updated_at) : '-'}} </td>
						<td> {{$notification->updated_at ? $notification->updated_at->format('H:i') : '-'}} </td>
						<td>
							<form class="d-inline" action="{{url("notifications/single/{$notification->id}")}}" method="post" id="delete-single-notification-{{$history->id}}">
								@method('DELETE')
								@csrf
								<button type="button" class="btn btn-outline-danger delete" data-toggle="popover" data-content="با حذف این آیتم اطلاع رسانی فقط برای این کاربر لغو میشود" data-trigger="hover" data-placement="top" data-target="delete-single-notification-{{$history->id}}">
									<i class="fa fa-trash ml-1"></i> حذف
								</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$notifications->links()}}
	</div>

@endsection
