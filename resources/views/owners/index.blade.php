@extends('layouts.dashboard')
@section('main')

	<div class="card mb-3">
		<div class="card-body text-left">
			<a class="btn btn-outline-primary" href="{{url("owners/create/$type")}}">
				<i class="fa fa-plus ml-1"></i>
				تعریف {{$persian_type}} جدید
			</a>
		</div>
	</div>

	<div class="tile">
		@if ($owners->count())
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col"> نام مسئول </th>
							@if ($type == 'organ')
								<th scope="col"> نام بنگاه </th>
							@elseif ($type == 'operator')
								<th scope="col"> منطقه فعالیت </th>
							@endif
							<th scope="col"> نام کاربری </th>
							<th scope="col" colspan="3"> عملیات </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($owners as $index => $owner)
							<tr>
								<th scope="row">{{$index+1}}</th>
								<td>{{$owner->full_name()}}</td>
								@if ($type == 'organ')
									<td> {{$owner->agency_name}} </td>
								@elseif ($type == 'operator')
									<td> {{$owner->region}} </td>
								@endif
								<td>{{$owner->user->username ?? '-'}}</td>
								<td>
									<a class="btn btn-outline-success" href="{{url("owners/$type/$owner->id/edit")}}">
										<i class="fa fa-edit ml-1"></i>
										ویرایش
									</a>
								</td>
								<td class="text-center">
									<form action="{{url("owners/$type/$owner->id")}}" method="post" id="delete-owner-{{$owner->id}}">
										@method('DELETE')
										@csrf
										<button type="button" class="btn btn-outline-danger delete" data-target="delete-owner-{{$owner->id}}">
											<i class="fa fa-trash ml-1"></i> حذف دائمی
										</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{$owners->links()}}
		@else
			<div class="alert alert-warning">
				موردی یافت نشد.
			</div>
		@endif
	</div>

@endsection
