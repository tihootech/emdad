<form id="searchbox" class="collapse" autocomplete="off">
	<hr>

	<div class="form-inline my-3">
		<i class="fa fa-asterisk text-info ml-2"></i>
		<span class="searchbox-width"> کدملی با عبارت  </span>
		<input type="text" class="form-control mx-2" name="national_code" value="{{request('national_code')}}">
		<span> شروع شود. </span>
	</div>
	<div class="form-inline form-group">
		<i class="fa fa-asterisk text-info ml-2"></i>
		<span class="searchbox-width"> سن شخص برابر با : </span>
		<input type="text" class="form-control mx-2" name="age" value="{{request('age')}}">
		<span> سال باشد. </span>
	</div>
	<div class="form-inline form-group">
		<i class="fa fa-asterisk text-info ml-2"></i>
		<span class="searchbox-width"> سن شخص بزرگتر یا مساوی </span>
		<input type="number" class="form-control mx-2" name="age_1" @unless(request('age')) value="{{request('age_1')}}" @endunless>
		<span> و کوچکتر از </span>
		<input type="number" class="form-control mx-2" name="age_2" @unless(request('age')) value="{{request('age_2')}}" @endunless>
		<span>
			باشد.
			<i class="fa fa-question-circle text-info" data-toggle="popover"
			data-content="اگر میخواهید مثلا افراد بزرگتر از 20 سال را پیدا کنید، میتوانید فیلد مربوط به کوچکتر را خالی بگذارید و یا بالعکس میتوانید فیلد بزرگتر مساوی را خالی بگذارید"
			data-trigger="hover" data-placement="top"
			></i>
		</span>
	</div>

	<hr>

	<div class="row justify-content-center">
		<div class="col-md-3 form-group">
			<label for="full-name"> نام یا نام خانوادگی </label>
			<input type="text" class="form-control" id="full-name" name="full_name" value="{{request('full_name')}}">
		</div>
		<div class="col-md-2 form-group">
			<label for="male"> جنسیت </label>
			<select class="form-control" name="male" id="male">
				<option value=""> -- همه موارد -- </option>
				<option @if( request('male') === '1' ) selected @endif value="1"> مرد </option>
				<option @if( request('male') === '0' ) selected @endif value="0"> زن </option>
			</select>
		</div>
		<div class="col-md-4 form-group">
			<label for="education-grade"> مقطع تحصیلی </label>
			<select class="select2" name="education_grade[]" id="education-grade" multiple>
				<option @if(is_array(request('education_grade')) && in_array('سیکل', request('education_grade'))) selected @endif > سیکل </option>
				<option @if(is_array(request('education_grade')) && in_array('دیپلم', request('education_grade'))) selected @endif > دیپلم </option>
				<option @if(is_array(request('education_grade')) && in_array('فوق دیپلم', request('education_grade'))) selected @endif > فوق دیپلم </option>
				<option @if(is_array(request('education_grade')) && in_array('لیسانس', request('education_grade'))) selected @endif > لیسانس </option>
				<option @if(is_array(request('education_grade')) && in_array('فوق لیسانس', request('education_grade'))) selected @endif > فوق لیسانس </option>
				<option @if(is_array(request('education_grade')) && in_array('دکتری', request('education_grade'))) selected @endif > دکتری </option>
			</select>
		</div>
		<div class="col-md-3 form-group">
			<label for="education-field-search"> رشته تحصیلی </label>
			<input type="text" class="form-control" id="education-field-search" name="education_field" value="{{request('education_field')}}">
		</div>
		@master
			<div class="col-md-2 form-group">
				<label for="region"> منطقه </label>
				<input type="number" class="form-control" id="region" name="region" value="{{request('region')}}">
			</div>
		@endmaster
		<div class="col-md-2 form-group">
			<label for="married"> وضعیت تاهل </label>
			<select class="form-control" name="married" id="married">
				<option value=""> -- همه موارد -- </option>
				<option @if( request('married') === '0' ) selected @endif value="0"> مجرد </option>
				<option @if( request('married') === '1' ) selected @endif value="1"> متاهل </option>
			</select>
		</div>
		<div class="col-md-3 form-group">
			<label for="military-status"> وضعیت نظام وظیفه </label>
			<select class="form-control" name="military_status" id="military-status">
				<option value=""> -- همه موارد -- </option>
				<option @if( request('military_status') == 'مشمول خدمت' ) selected @endif > مشمول خدمت </option>
				<option @if( request('military_status') == 'معاف یا پایان خدمت' ) selected @endif > معاف یا پایان خدمت </option>
			</select>
		</div>
		<div class="col-md-5 form-group">
			<label for="skill"> مهارت </label>
			<input type="text" class="form-control" id="skill" name="skill" value="{{request('skill')}}">
		</div>
		<div class="col-md-5 form-group">
			<label for="training"> آموزش </label>
			<input type="text" class="form-control" id="training" name="training" value="{{request('training')}}">
		</div>
	</div>

	<hr>
	<div class="text-center">
		<a href="{{url("madadju")}}" class="btn btn-warning mx-1"> <i class="fa fa-times ml-1"></i> لغو جستجو </a>
		<button type="submit" class="btn btn-primary mx-1"> <i class="fa fa-search ml-1"></i> جستجو </button>
	</div>
</form>
