@extends('layouts.dashboard')
@section('main')

	<div class="tile text-left">
		<a href="{{url("notifications")}}" class="btn btn-outline-info"> تاریخچه اطلاع رسانی </a>
	</div>

	<div class="tile">
		<h4> اطلاع رسانی به متصدیان </h4>
		<hr>
		@if ($operators->count())
			<form action="{{url("notifications/operator")}}" method="post">
				@csrf
				<div class="my-2">
					<label for="body"> متن پیغام </label>
					<textarea name="body" id="body" rows="4" class="form-control" required>{{old('body')}}</textarea>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary"> اطلاع رسانی </button>
				</div>
			</form>
		@else
			<div class="alert alert-warning">
				<i class="fa fa-warning ml-1"></i>
				هنوز هیچ متصدی در سیستم تعریف نشده است.
			</div>
		@endif
	</div>
	<div class="tile">
		<h4> اطلاع رسانی به موسسات </h4>
		<hr>
		@if ($organs->count())
			<form action="{{url("notifications/organ")}}" method="post">
				@csrf
				<div class="my-2">
					<label for="body"> متن پیغام </label>
					<textarea name="body" id="body" rows="4" class="form-control" required>{{old('body')}}</textarea>
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
