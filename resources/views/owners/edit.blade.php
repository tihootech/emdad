@extends('layouts.dashboard')
@section('main')

	<div class="tile">
		<form class="row justify-content-center" action="{{url("owner/$user->owner_id")}}" method="post">
			@csrf
			@method('PUT')
			<input type="hidden" name="owner_type" value="{{$user->owner_type}}">

			<div class="col-md-4 form-group">
				<label> نام </label>
				<input type="text" class="form-control" name="first_name" value="{{old('first_name') ?? $user->owner->first_name ?? null}}" required>
			</div>
			<div class="col-md-4 form-group">
				<label> نام خانوادگی </label>
				<input type="text" class="form-control" name="last_name" value="{{old('last_name') ?? $user->owner->last_name ?? null}}" required>
			</div>

			@if ($user->is_organ())
				<hr class="w-100">
				<div class="col-md-4 form-group">
					<label> کدملی </label>
					<input type="text" class="form-control" name="national_code" value="{{old('national_code') ?? $user->owner->national_code ?? null}}">
				</div>
				<div class="col-md-4 form-group">
					<label> تحصیلات </label>
					<input type="text" class="form-control" name="education" value="{{old('education') ?? $user->owner->education ?? null}}">
				</div>
				<div class="col-md-4 form-group">
					<label> شماره تماس </label>
					<input type="text" class="form-control" name="telephone" value="{{old('telephone') ?? $user->owner->telephone ?? null}}">
				</div>
				<div class="col-md-4 form-group">
					<label> نام بنگاه </label>
					<input type="text" class="form-control" name="agency_name" value="{{old('agency_name') ?? $user->owner->agency_name ?? null}}" required>
				</div>
				<div class="col-md-4 form-group">
					<label> نوع محصولات </label>
					<input type="text" class="form-control" name="product_type" value="{{old('product_type') ?? $user->owner->product_type ?? null}}">
				</div>
				<div class="col-md-12 form-group">
					<label> آدرس </label>
					<input type="text" class="form-control" name="address" value="{{old('address') ?? $user->owner->address ?? null}}">
				</div>
			@endif

			<hr class="w-100">

			<div class="col-md-2">
				<button type="submit" class="btn btn-primary btn-block"> ذخیره </button>
			</div>

		</form>
	</div>

@endsection
