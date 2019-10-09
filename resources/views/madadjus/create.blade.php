@extends('layouts.dashboard')
@section('main')

	<div class="container">

		<div class="text-left">
			<a href="{{url("madadju")}}" class="btn btn-outline-primary">
				<i class="fa fa-users ml-1"></i>
				لیست مددجویان
			</a>
		</div>
		<hr>

		<form class="row justify-content-center" action="{{url("madadju/$madadju->id")}}" method="post">

			@if ($madadju->id)
				@method('PUT')
			@endif
			@csrf

			<div class="col-md-3 form-group">
				<label for="full-name"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نام و نام خانوادگی </label>
				<input type="text" class="form-control" id="full-name" name="full_name" value="{{old('full_name') ?? $madadju->full_name}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="father-name"> نام پدر <small>(اختیاری)</small> </label>
				<input type="text" class="form-control" id="father-name" name="father_name" value="{{old('father_name') ?? $madadju->father_name}}">
			</div>

			<div class="col-md-3 form-group">
				<label for="birthday"> تاریخ تولد <small>(اختیاری)</small> </label>
				<input type="text" class="form-control pdp" id="birthday" name="birthday" value="{{old('birthday') ?? date_picker_date($madadju->birthday)}}" autocomplete="off" placeholder="انتخاب تاریخ">
			</div>

			<div class="col-md-3 form-group">
				<label for="national-code"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> کدملی </label>
				<input type="text" class="form-control" id="national-code" name="national_code" value="{{old('national_code') ?? $madadju->national_code}}" required>
			</div>

			<div class="w-100 form-group">
				<label for="description"> توضیحات <small>(اختیاری)</small> </label>
				<textarea name="description" id="description" name="description" class="form-control">{{old('description') ?? $madadju->description}}</textarea>
			</div>

			<hr class="w-100">

			<div class="col-md-2">
				@include('partials.submit')
			</div>

		</form>

	</div>

@endsection
