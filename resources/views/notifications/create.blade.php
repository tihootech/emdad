@extends('layouts.dashboard')
@section('main')

	<div class="tile text-left">
		<a href="{{url("notifications/history")}}" class="btn btn-outline-info"> تاریخچه اطلاع رسانی </a>
	</div>

	<div class="tile">
		<h4> اطلاع رسانی به مددکارها </h4>
		<hr>
		@if ($operators->count())
			<form action="{{url("notifications")}}" method="post">
				@csrf
				<input type="hidden" name="target" value="App\Operator">
				<div class="row justify-content-center">
					<div class="col-md-12 form-group">
						<label for="body"> متن اعلامیه </label>
						<textarea name="body" id="body" rows="4" class="form-control" required>{{old('body')}}</textarea>
					</div>
					<div class="col-md-4 form-group">
						<label for="region"> منطقه </label>
						<input type="number" name="region" id="region" value="{{old('region')}}" class="form-control">
						<small class="text-muted">
							<i class="fa fa-info-circle ml-1"></i>
							در صورتی که میخواهید این اعلامیه فقط برای منطقه خاصی ارسال شود
							میتوانید عدد منطقه مورد نظر را وارد کنید.
							در غیر این صورت میتوانید این فیلد را خالی بگذارید.
						</small>
					</div>
					<div class="col-md-6 form-group">
						<label for="operator"> انتخاب مددکار/مددکارها </label>
						<select class="select2" name="owner_ids[]" id="operator" multiple>
							@foreach ($operators as $operator)
								<option value="{{$operator->id}}"> {{$operator->title()}} </option>
							@endforeach
						</select>
						<small class="text-muted">
							<i class="fa fa-info-circle ml-1"></i>
							در صورتی که میخواهید این اعلامیه فقط برای برخی از مددکارها به صورت انتخابی ارسال شود
							میتوانید مددکارها مورد نظر خود را از لیست بالا انتخاب کنید.
							در غیر این صورت میتوانید این فیلد را خالی بگذارید.
							لازم به ذکر است که شما میتوانید یک یا بیش از یک مددکار را انتخاب کنید.
						</small>
					</div>
				</div>
				<hr>
				<div class="text-center">
					<button type="submit" class="btn btn-primary"> اطلاع رسانی </button>
				</div>
			</form>
		@else
			<div class="alert alert-warning">
				<i class="fa fa-warning ml-1"></i>
				هنوز هیچ مددکار در سیستم تعریف نشده است.
			</div>
		@endif
	</div>
	<div class="tile">
		<h4> اطلاع رسانی به موسسات </h4>
		<hr>
		@if ($organs->count())
			<form action="{{url("notifications")}}" method="post">
				@csrf
				<input type="hidden" name="target" value="App\Organ">
				<div class="row justify-content-center">
					<div class="col-md-12 form-group">
						<label for="body"> متن اعلامیه </label>
						<textarea name="body" id="body" rows="4" class="form-control" required>{{old('body')}}</textarea>
					</div>
					<div class="col-md-6 form-group">
						<label for="organ"> انتخاب موسسه/موسسات </label>
						<select class="select2" name="owner_ids[]" id="organ" multiple>
							@foreach ($organs as $organ)
								<option value="{{$organ->id}}"> {{$organ->title()}} </option>
							@endforeach
						</select>
						<small class="text-muted">
							<i class="fa fa-info-circle ml-1"></i>
							در صورتی که میخواهید این اعلامیه فقط برای برخی از موسسات به صورت انتخابی ارسال شود
							میتوانید موسسات مورد نظر خود را از لیست بالا انتخاب کنید.
							در غیر این صورت میتوانید این فیلد را خالی بگذارید.
							لازم به ذکر است که شما میتوانید یک یا بیش از یک موسسه را انتخاب کنید.
						</small>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary"> اطلاع رسانی </button>
				</div>
			</form>
		@else
			<div class="alert alert-warning">
				<i class="fa fa-warning ml-1"></i>
				هنوز هیچ ارگانی در سیستم تعریف نشده است.
			</div>
		@endif
	</div>
@endsection
