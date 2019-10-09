@extends('layouts.dashboard')
@section('main')

	<div class="card mb-3">
		<div class="card-body text-left">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#NewUserModal">
				<i class="fa fa-user-plus ml-1"></i>
				تعریف {{$persian_type}} جدید
			</button>
		</div>
	</div>

	<div class="tile">
		@if ($users->count())
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col"> نام </th>
						<th scope="col"> نام کاربری </th>
						<th scope="col" colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $index => $user)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td>{{$user->name}}</td>
							<td>{{$user->username}}</td>
							<td>
								<form class="form-inline" action="{{url("acc/$user->id")}}" method="post">
									@method('PUT')
									@csrf
									<input type="text" class="form-control mx-1" name="password" required placeholder="رمزعبور جدید">
									<button type="submit" class="btn btn-primary mx-1">
										<i class="fa fa-unlock ml-1"></i>
										تغییر رمزعبور
									</button>
								</form>
							</td>
							<td class="text-center">
								<form action="{{url("acc/$user->id")}}" method="post">
									@method('DELETE')
									@csrf
									<button type="submit" class="btn btn-danger" onclick="if (!confirm('آیا مطمئن هستید؟')) return false;">
										<i class="fa fa-trash ml-1"></i> حذف دائمی
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="alert alert-warning">
				موردی یافت نشد.
			</div>
		@endif
	</div>

	<!-- Modal -->
	<div class="modal fade" id="NewUserModal" tabindex="-1" role="dialog" aria-labelledby="NewUserModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="NewUserModalLabel">
						تعریف {{$persian_type}} جدید
					</h5>
					<button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"> <i class="fa fa-times"></i> </span>
					</button>
				</div>
				<div class="modal-body">
					<form class="row" action="{{url('users')}}" method="post" id="new-user-form">
						@csrf
						<input type="hidden" name="type" value="{{$type}}">

						<div class="col-md-4 form-group">
							<label for="name"> نام {{$persian_type}} </label>
							<input type="text" class="form-control" name="name" value="{{old('name')}}" required>
						</div>

						<div class="col-md-4 form-group">
							<label for="username"> نام کاربری </label>
							<input type="text" class="form-control" name="username" value="{{old('username')}}" required>
						</div>

						<div class="col-md-4 form-group">
							<label for="password"> رمزعبور </label>
							<input type="text" class="form-control" name="password" value="{{old('password')}}" required>
						</div>

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary mx-1" data-dismiss="modal"> انصراف </button>
					<button type="submit" class="btn btn-primary mx-1" form="new-user-form"> تایید </button>
				</div>
			</div>
		</div>
	</div>

@endsection
