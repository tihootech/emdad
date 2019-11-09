@extends('layouts.dashboard')
@section('main')

	<div class="tile">
		<form action="{{url("owners/$owner->id")}}" method="post">
			@csrf
			@if ($owner->id)
				@method('PUT')
			@endif
			<input type="hidden" name="owner_type" value="{{class_name($type)}}">
			<input type="hidden" name="type" value="{{$type}}">


			<h4 class="text-info"> اطلاعات حساب کاربری </h4>
			<div class="row justify-content-center">
				<div class="col-md-4 form-group">
					<label> نام کاربری </label>
					<input type="text" class="form-control" name="username" value="{{old('username') ?? $owner->user->username ?? null}}" required>
				</div>
				@if ($owner->id)
					<div class="col-md-4 form-group">
						<label> رمز عبور جدید </label>
						<input type="text" class="form-control" name="new_password" value="{{old('new_password')}}" autocomplete="off">
					</div>
					<div class="col-md-8 form-group text-info">
						<i class="fa fa-asterisk ml-1"></i>
						<small> <b class="text-info"> درصورتی که میخواهید رمز عبور را تغییر دهید، میتوانید رمزعبور جدید را وارد کنید. در غیراینصورت میتوانید رمز عبور را خالی بگذارید. </b> </small>
					</div>
				@else
					<div class="col-md-4 form-group">
						<label> رمز عبور </label>
						<input type="text" class="form-control" name="password" value="{{old('password')}}" autocomplete="off" required>
					</div>
				@endif
			</div>

			<h4 class="text-info"> اطلاعات اصلی </h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-md-4 form-group">
					<label> نام مسئول </label>
					<input type="text" class="form-control" name="first_name" value="{{old('first_name') ?? $owner->first_name ?? null}}" required>
				</div>
				<div class="col-md-4 form-group">
					<label> نام خانوادگی مسئول </label>
					<input type="text" class="form-control" name="last_name" value="{{old('last_name') ?? $owner->last_name ?? null}}" required>
				</div>

				@if ($type == 'organ')
					<div class="col-md-4 form-group">
						<label> نام بنگاه </label>
						<input type="text" class="form-control" name="agency_name" value="{{old('agency_name') ?? $owner->agency_name ?? null}}" required>
					</div>
					<div class="col-md-3 form-group">
						<label> کدملی </label>
						<input type="text" class="form-control" name="national_code" value="{{old('national_code') ?? $owner->national_code ?? null}}">
					</div>
					<div class="col-md-3 form-group">
						<label> تحصیلات </label>
						<input type="text" class="form-control" name="education" value="{{old('education') ?? $owner->education ?? null}}">
					</div>
					<div class="col-md-3 form-group">
						<label> شماره تماس </label>
						<input type="text" class="form-control" name="telephone" value="{{old('telephone') ?? $owner->telephone ?? null}}">
					</div>
					<div class="col-md-3 form-group">
						<label> نوع محصولات </label>
						<input type="text" class="form-control" name="product_type" value="{{old('product_type') ?? $owner->product_type ?? null}}">
					</div>
					<div class="col-md-12 form-group">
						<label> آدرس </label>
						<input type="text" class="form-control" name="address" value="{{old('address') ?? $owner->address ?? null}}">
					</div>
				@endif

				@if ($type == 'operator')
					<div class="col-md-2 form-group">
						<label> منطقه فعالیت </label>
						<input type="number" class="form-control" name="region" value="{{old('region') ?? $owner->region ?? null}}" required>
					</div>
				@endif

				<hr class="w-100">
				<div class="col-md-2">
					<button type="submit" class="btn btn-primary btn-block"> ذخیره </button>
				</div>

			</div>


		</form>
	</div>

@endsection
