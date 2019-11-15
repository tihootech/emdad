@extends('layouts.dashboard')
@section('main')

	<div class="text-left">
		<a href="{{url("madadju")}}" class="btn btn-outline-primary">
			<i class="fa fa-users ml-1"></i>
			لیست مددجویان
		</a>
	</div>
	<hr>

	<div class="tile">
		<form class="row" action="{{url("madadju/$madadju->id")}}" method="post" autocomplete="off">

			@if ($madadju->id)
				@method('PUT')
			@endif
			@csrf

			<h5 class="col-12 text-info mb-4"> <i class="fa fa-address-book-o ml-1"></i> اطلاعات شخصی </h5>

			<div class="col-md-3 form-group">
				<label for="first-name"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نام </label>
				<input type="text" class="form-control" id="first-name" name="first_name" value="{{old('first_name') ?? $madadju->first_name}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="last-name"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نام خانوادگی </label>
				<input type="text" class="form-control" id="last-name" name="last_name" value="{{old('last_name') ?? $madadju->last_name}}" required>
			</div>

			<div class="col-md-2 form-group">
				<label for="national-code"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> کدملی </label>
				<input type="text" class="form-control" id="national-code" name="national_code" value="{{old('national_code') ?? $madadju->national_code}}" required>
			</div>

			<div class="col-md-2 form-group">
				<label for="birthday"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> تاریخ تولد </label>
				<input type="text" class="form-control pdp" id="birthday" name="birthday" value="{{old('birthday') ?? date_picker_date($madadju->birthday)}}" autocomplete="off" placeholder="انتخاب تاریخ" required>
			</div>

			<div class="col-md-2 form-group">
				<label for="male"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> جنسیت </label>
				<select class="form-control" name="male" id="male" required>
					<option @if( select_old('male', 1, $madadju) ) selected @endif value="1"> مرد </option>
					<option @if( select_old('male', 0, $madadju) ) selected @endif value="0"> زن </option>
				</select>
			</div>


			<div class="col-md-2 form-group">
				<label for="telephone"> تلفن </label>
				<input type="text" class="form-control" id="telephone" name="telephone" value="{{old('telephone') ?? $madadju->telephone}}">
			</div>

			<div class="col-md-2 form-group">
				<label for="mobile"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> موبایل  </label>
				<input type="text" class="form-control" id="mobile" name="mobile" value="{{old('mobile') ?? $madadju->mobile}}" required>
			</div>

			<div class="col-md-2 form-group">
				<label for="married"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> وضعیت تاهل </label>
				<select class="form-control" name="married" id="married" required>
					<option @if( select_old('married', 0, $madadju) ) selected @endif value="0"> مجرد </option>
					<option @if( select_old('married', 1, $madadju) ) selected @endif value="1"> متاهل </option>
				</select>
			</div>


			<div class="col-md-3 form-group">
				<label for="warden-name"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نام و نام خانوادگی سرپرست </label>
				<input type="text" class="form-control" id="warden-name" name="warden_name" value="{{old('warden_name') ?? $madadju->warden_name}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="warden-national-code"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> کدملی سرپرست </label>
				<input type="text" class="form-control" id="warden-national-code" name="warden_national_code" value="{{old('warden_national_code') ?? $madadju->warden_national_code}}" required>
			</div>


			<div class="col-md-12 form-group">
				<label for="address"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> آدرس </label>
				<textarea name="address" id="address" name="address" rows="2" class="form-control" required>{{old('address') ?? $madadju->address}}</textarea>
			</div>

			<hr class="w-100">
			<h5 class="col-12 text-info mb-4"> <i class="fa fa-graduation-cap ml-1"></i> تحصیلات </h5>

			<div class="col-md-3 form-group">
				<label for="education-grade"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> مقطع تحصیلی </label>
				<select class="form-control" name="education_grade" id="education-grade" required>
					<option value=""> -- انتخاب کنید -- </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'بی سواد') selected @endif > بی سواد </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'سیکل') selected @endif > سیکل </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'دیپلم') selected @endif > دیپلم </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'فوق دیپلم') selected @endif > فوق دیپلم </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'لیسانس') selected @endif > لیسانس </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'فوق لیسانس') selected @endif > فوق لیسانس </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'دکتری') selected @endif > دکتری </option>
				</select>
			</div>

			<div class="col-md-3 form-group">
				<label for="education-field"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> رشته تحصیلی </label>
				<input type="text" class="form-control" id="education-field" name="education_field" value="{{old('education_field') ?? $madadju->education_field}}">
			</div>

			<hr class="w-100">
			<h5 class="col-12 text-info mb-4"> <i class="fa fa-list ml-1"></i> سایر اطلاعات </h5>

			<div class="col-md-3 form-group">
				<label for="muid"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> کد مددجویی </label>
				<input type="text" class="form-control" id="muid" name="muid" value="{{old('muid') ?? $madadju->muid}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="military-status"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> وضعیت نظام وظیفه </label>
				<select class="form-control" name="military_status" id="military-status" required>
					<option @if((old('military_status') ?? $madadju->military_status) == 'مشمول خدمت') selected @endif > مشمول خدمت </option>
					<option @if((old('military_status') ?? $madadju->military_status) == 'معاف یا پایان خدمت') selected @endif > معاف یا پایان خدمت </option>
				</select>
			</div>

			<div class="col-md-2 form-group">
				<label for="region"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> منطقه </label>
				<input type="number" class="form-control" id="region" name="region" required
					@master
						value="{{old('region') ?? $madadju->region}}"
					@else
						value="{{auth()->user()->region()}}" readonly
					@endmaster
				>
			</div>

			<div class="col-md-4 form-group">
				<label for="insurance-number"> شماره بیمه </label>
				<input type="text" class="form-control" id="insurance-number" name="insurance_number" value="{{old('insurance_number') ?? $madadju->insurance_number}}">
			</div>

			<div class="col-md-12 form-group">
				<label for="skill"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> مهارت </label>
				<input type="text" class="form-control" id="skill" name="skill" value="{{old('skill') ?? $madadju->skill}}" قثضعهقثی>
			</div>

			<div class="col-md-5 form-group">
				<label for="training"> آموزش </label>
				<input type="text" class="form-control" id="training" name="training" value="{{old('training') ?? $madadju->training}}">
			</div>

			<div class="col-md-5 form-group">
				<label for="favourites"> علاقه مندی ها </label>
				<input type="text" class="form-control" id="favourites" name="favourites" value="{{old('favourites') ?? $madadju->favourites}}">
			</div>

			<div class="col-md-2 form-group">
				<label for="work-experience"> تجربه </label>
				<select class="form-control" name="work_experience" id="work-experience" required
					onchange="$('#experience-div').slideToggle()">
					<option @if( select_old('work_experience', 0, $madadju) ) selected @endif value="0"> خیر </option>
					<option @if( select_old('work_experience', 1, $madadju) ) selected @endif value="1"> بله </option>
				</select>
			</div>

			<div class="col-md-12 form-group @unless($madadju->work_experience) hidden @endunless" id="experience-div">
				<label for="experience"> تجارب شخص </label>
				<input type="text" class="form-control" id="experience" name="experience" value="{{old('experience') ?? $madadju->experience}}">
			</div>

			<hr class="w-100">

			<div class="col-md-2 mx-auto">
				@include('partials.submit')
			</div>

		</form>
	</div>

@endsection
