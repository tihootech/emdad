@extends('layouts.dashboard')
@section('main')

	<div class="card mb-3">
		<div class="card-body">

			<div class="text-left">
				<a class="btn btn-outline-primary mx-1" data-toggle="collapse" href="#searchbox">
					<i class="fa fa-search ml-1"></i>
					جستجوی پیشرفته
				</a>
				<a href="{{url("madadju/create")}}" class="btn btn-outline-primary mx-1">
					<i class="fa fa-user-plus ml-1"></i>
					ایجاد مددجو
				</a>
			</div>

			<form id="searchbox" class="collapse">
				<hr>
				<div class="form-inline form-group">
					<i class="fa fa-asterisk text-info ml-2"></i>
					<span class="searchbox-width"> نام و نام خانوادگی : </span>
					<select class="searchbox-width form-control mx-2" name="full_name_type">
						<option @if(request('full_name_type') == 'like')selected  @endif value="like"> حاوی عبارت </option>
						<option @if(request('full_name_type') == '=') selected @endif value="="> دقیقا برابر با </option>
					</select>
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
	</div>

	<div class="tile">
		@if ($madadjus->count())
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col"> نام و نام خانوادگی </th>
						<th scope="col"> نام پدر </th>
						<th scope="col"> تاریخ تولد </th>
						<th scope="col"> سن </th>
						<th scope="col"> کدملی </th>
						<th scope="col"> توضیحات </th>
						<th scope="col" colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($madadjus as $index => $madadju)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td>{{$madadju->full_name ?? '-'}}</td>
							<td>{{$madadju->father_name ?? '-'}}</td>
							<td>{{$madadju->birthday ? date_picker_date($madadju->birthday) : '-'}}</td>
							<td>{{$madadju->age() ?? '-'}}</td>
							<td>{{$madadju->national_code ?? '-'}}</td>
							<td>
								@if ($madadju->description)
									<i class="fa fa-question-circle" data-toggle="popover" data-content="{{$madadju->description}}" data-trigger="hover" data-placement="top"></i>
								@else
									-
								@endif
							</td>
							<td>
								<a href="{{url("madadju/$madadju->id/edit")}}" class="btn btn-outline-success">
									<i class="fa fa-edit ml-1"></i>
									ویرایش
								</a>
							</td>
							<td class="text-center">
								<form action="{{url("madadju/$madadju->id")}}" method="post">
									@method('DELETE')
									@csrf
									<button type="submit" class="btn btn-outline-danger" onclick="if (!confirm('آیا مطمئن هستید؟')) return false;">
										<i class="fa fa-trash ml-1"></i> حذف
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

@endsection
