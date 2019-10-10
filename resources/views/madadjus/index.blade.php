@extends('layouts.dashboard')
@section('main')

	<div class="tile">

		<div class="text-left">
			<a class="btn btn-outline-info mx-1" data-toggle="collapse" href="#searchbox">
				<i class="fa fa-search ml-1"></i>
				جستجوی پیشرفته
			</a>
			<a href="{{url("madadju/create")}}" class="btn btn-outline-primary mx-1">
				<i class="fa fa-user-plus ml-1"></i>
				ایجاد مددجو جدید
			</a>
		</div>

		<form id="searchbox" class="collapse">
			<hr>
			<div class="form-inline form-group">
				<i class="fa fa-asterisk text-info ml-2"></i>
				<span class="searchbox-width"> نام و نام خانوادگی حاوی عبارت </span>
				<input type="text" class="form-control ml-2" name="full_name" value="{{request('full_name')}}">
				<span> باشد. </span>
			</div>
			<div class="form-inline form-group">
				<i class="fa fa-asterisk text-info ml-2"></i>
				<span class="searchbox-width"> نام پدر : </span>
				<select class="searchbox-width form-control mx-2" name="father_name_type">
					<option @if(request('father_name_type') == 'like')selected  @endif value="like"> حاوی عبارت </option>
					<option @if(request('father_name_type') == '=') selected @endif value="="> دقیقا برابر با </option>
				</select>
				<input type="text" class="form-control ml-2" name="father_name" value="{{request('father_name')}}">
				<span> باشد. </span>
			</div>
			<div class="form-inline form-group">
				<i class="fa fa-asterisk text-info ml-2"></i>
				<span class="searchbox-width"> سن شخص برابر با : </span>
				<input type="text" class="form-control mx-2" name="age" value="{{request('age')}}">
				<span> سال باشد. </span>
			</div>
			<div class="form-inline form-group">
				<i class="fa fa-asterisk text-info ml-2"></i>
				<span> سن شخص بزرگتر یا مساوی </span>
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
			<div class="form-inline form-group">
				<i class="fa fa-asterisk text-info ml-2"></i>
				<span> کدملی با عبارت  </span>
				<input type="text" class="form-control mx-2" name="national_code" value="{{request('national_code')}}">
				<span> شروع شود. </span>
			</div>
			<div class="form-group">
				<i class="fa fa-asterisk text-info ml-2"></i>
				<span> توضیحات </span>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="description" name="description" {{ request('description') ? 'checked' : '' }}>
					<label class="custom-control-label" for="description">
						<span> توضیحات داشته باشد </span>
					</label>
				</div>
			</div>
			<hr>
			<div class="text-center">
				<a href="{{url("madadju")}}" class="btn btn-warning mx-1"> <i class="fa fa-times ml-1"></i> لغو جستجو </a>
				<button type="submit" class="btn btn-primary mx-1"> <i class="fa fa-search ml-1"></i> جستجو </button>
			</div>
		</form>

	</div>

	<div class="tile">
		@if ($madadjus->count())
			<table class="table table-bordered table-hover table-striped table-sm table-responsive">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col"> <i class="fa fa-square-o" data-checked="0" data-check="all"></i> </th>
						<th scope="col"> نام و نام خانوادگی </th>
						<th scope="col"> کدملی </th>
						<th scope="col"> کد مددجویی </th>
						<th scope="col"> تاریخ تولد </th>
						<th scope="col"> سن </th>
						<th scope="col"> جنسیت </th>
						<th scope="col"> مقطع تحصیلی </th>
						<th scope="col"> موبایل </th>
						<th scope="col"> وضعیت تاهل </th>
						<th scope="col"> وضعیت نظام وظیفه </th>
						<th scope="col"> نام سرپرست </th>
						<th scope="col" colspan="3"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($madadjus as $index => $madadju)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td> <i class="fa fa-square-o" data-checked="0" data-check="{{$madadju->id}}"></i> </td>
							<td class="@if($madadju->introduces->count()) bg-red-light @else bg-green-light @endif" data-toggle="popover" data-content="@if($madadju->introduces->count()) معرفی شده @else معرفی نشده @endif" data-trigger="hover" data-placement="top">
								{{$madadju->full_name() }}
							</td>
							<td>{{$madadju->national_code ?? '-'}}</td>
							<td>{{$madadju->muid ?? '-'}}</td>
							<td>{{$madadju->birthday ? date_picker_date($madadju->birthday) : '-'}}</td>
							<td>{{$madadju->age()}}</td>
							<td>{{$madadju->male ? 'مرد' : 'زن'}}</td>
							<td>{{$madadju->education_grade ?? '-'}}</td>
							<td>{{$madadju->mobile ?? '-'}}</td>
							<td>{{$madadju->married ? 'متاهل' : 'مجرد'}}</td>
							<td>{{$madadju->military_status ?? '-'}}</td>
							<td>{{$madadju->warden_name ?? '-'}}</td>
							<td>
								<a href="{{url("madadju/$madadju->id")}}" class="btn btn-sm btn-outline-primary" data-toggle="popover" data-content="جزییات" data-trigger="hover" data-placement="top">
									<i class="fa fa-list ml-1"></i>
								</a>
							</td>
							<td>
								<a href="{{url("madadju/$madadju->id/edit")}}" class="btn btn-sm btn-outline-success" data-toggle="popover" data-content="ویرایش" data-trigger="hover" data-placement="top">
									<i class="fa fa-edit ml-1"></i>
								</a>
							</td>
							<td class="text-center">
								<form action="{{url("madadju/$madadju->id")}}" method="post" id="delete-madadju-{{$madadju->id}}">
									@method('DELETE')
									@csrf
									<button type="button" class="btn btn-sm btn-outline-danger delete" data-toggle="popover" data-content="حذف" data-trigger="hover" data-placement="top" data-target="delete-madadju-{{$madadju->id}}">
										<i class="fa fa-trash ml-1"></i>
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{{$madadjus->links()}}
		@else
			<div class="alert alert-warning">
				موردی یافت نشد.
			</div>
		@endif
	</div>

	<div class="tile">
		@csrf
		@if ($organs->count())
			<form class="row justify-content-center" action="{{url("introduce")}}" method="post" id="checked-form">
				@csrf
				<div class="col-md-4">
					<label for="organ"> انتخاب موسسه </label>
					<select class="select2" name="organ_id" id="organ" required>
						<option value=""></option>
						@foreach ($organs as $organ)
							<option @if(old('organ_id') == $organ->id) selected @endif value="{{$organ->id}}">{{$organ->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="w-100"></div>
				<div class="col-md-2 mt-3">
					<button type="submit" class="btn btn-block btn-outline-success" form="checked-form">
						<i class="fa fa-handshake-o ml-1"></i>
						معرفی
					</button>
				</div>
			</form>
		@else
			<div class="alert alert-warning">
				<i class="fa fa-warning ml-1"></i>
				برای معرفی به موسسات، ابتدا نیاز هست که در سیستم موسسات را تعریف کنید.
			</div>
		@endif

	</div>

@endsection
