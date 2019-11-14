@extends('layouts.dashboard')
@section('main')

	<div class="tile">

		@if ($list->count())

			<table class="table table-bordered table-hover table-striped table-responsive-lg">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col"> خطاب به </th>
						<th scope="col"> متن </th>
						<th scope="col"> تاریخ </th>
						<th scope="col" data-toggle="popover" data-content="این اعلامیه برای چند کاربر ارسال شده است." data-placement="top" data-trigger="hover"> تعداد کاربران </th>
						<th scope="col"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($list as $i => $history)
						<tr>
							<th scope="row"> {{$i+1}} </th>
							<td> {{persian($history->target, true)}} </td>
							<td> {{short($history->body, 33)}} </td>
							<td> {{human_date($history->created_at)}} </td>
							<td> {{$history->send_to_count()}} </td>
							<td>
								<a href="{{url("notifications/history/manage/$history->id")}}" class="btn btn-outline-primary ml-2">
									<i class="fa fa-cogs ml-1"></i> مدیریت
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>


			{{$list->links()}}

		@else
			<div class="alert alert-warning">
				موردی یافت نشد.
			</div>
		@endif

	</div>

@endsection
