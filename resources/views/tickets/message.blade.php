@extends('layouts.dashboard')
@section('title') درج پاسخ برای نامه {{$ticket->uid}} @endsection
@section('main')
	<div class="tile">

		<form class="row justify-content-center" action="{{url("ticket/message/$ticket->uid")}}" method="post" enctype="multipart/form-data">

			@csrf

			<div class="col-md-3 form-group">
				<label for="file"> ضمیمه کردن فایل </label>
				<input type="file" name="file" class="form-control">
			</div>

			<div class="col-md-12 form-group">
				<label for="body"> متن پاسخ </label>
				<textarea name="body" id="body" rows="8" class="form-control" required>{{old('body')}}</textarea>
			</div>

			<div class="col-md-2 form-group">
				<button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-check ml-1"></i> تایید </button>
			</div>

		</form>

	</div>
@endsection
