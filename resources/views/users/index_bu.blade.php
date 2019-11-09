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
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col"> نام </th>
							<th scope="col"> نام کاربری </th>
							<th scope="col" colspan="3"> عملیات </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $index => $user)
							<tr>
								<th scope="row">{{$index+1}}</th>
								<td>{{$user->owner ? $user->owner->title() : '-'}}</td>
								<td>{{$user->username}}</td>
								<td>
									<form action="{{url("acc/$user->id")}}" method="post">
										@method('PUT')
										@csrf
										<input type="text" class="form-control my-1" name="username" required placeholder="نام کاربری جدید" value="{{$user->username}}">
										<input type="text" class="form-control my-1" name="password" required placeholder="رمزعبور جدید">
										<button type="submit" class="btn btn-primary btn-block my-1">
											<i class="fa fa-unlock ml-1"></i>
											تغییر اطلاعات کاربری
										</button>
									</form>
								</td>
								<td>
									@if ($user->is_organ() && !($user->owner && $user->owner->agency_name) )
										<a class="btn btn-outline-info" href="{{url("owner/$user->id/edit")}}">
											<i class="fa fa-check ml-1"></i>
											تکمیل اطلاعات
										</a>
									@else
										<a class="btn btn-outline-success" href="{{url("owner/$user->id/edit")}}">
											<i class="fa fa-edit ml-1"></i>
											ویرایش
										</a>
									@endif
								</td>
								<td class="text-center">
									<form action="{{url("acc/$user->id")}}" method="post" id="delete-user-{{$user->id}}">
										@method('DELETE')
										@csrf
										<button type="button" class="btn btn-outline-danger delete" data-target="delete-user-{{$user->id}}">
											<i class="fa fa-trash ml-1"></i> حذف دائمی
										</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			<div class="alert alert-warning">
				موردی یافت نشد.
			</div>
		@endif
	</div>

	<!-- Modal -->
	<div class="modal fade" id="NewUserModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="NewUserModalLabel">
						تعریف <b class="text-primary"> {{$persian_type}} </b> جدید
					</h5>
					<button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"> <i class="fa fa-times"></i> </span>
					</button>
				</div>
				<div class="modal-body">
					<form class="row" action="{{url('users')}}" method="post" id="new-user-form">
						@csrf
						<input type="hidden" name="owner_type" value="{{class_name($type)}}">

						<div class="col-md-3 form-group">
							<label> نام مسئول </label>
							<input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" required>
						</div>

						<div class="col-md-3 form-group">
							<label> نام خانوادگی مسئول </label>
							<input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" required>
						</div>

						<div class="col-md-3 form-group">
							<label for="username"> نام کاربری </label>
							<input type="text" class="form-control" name="username" value="{{old('username')}}" required autocomplete="off">
						</div>

						<div class="col-md-3 form-group">
							<label for="password"> رمزعبور </label>
							<input type="text" class="form-control" name="password" value="{{old('password')}}" required autocomplete="off">
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
