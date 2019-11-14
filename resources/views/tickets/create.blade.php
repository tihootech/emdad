@extends('layouts.dashboard')
@section('title') ایجاد نامه جدید @endsection
@section('main')
	<div class="tile">

		<form class="row justify-content-center" action="{{url("ticket")}}" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="notification_history_uid" value="{{request('nuid')}}">

			<div class="col-md-4 form-group">
				<label for="title"> عنوان </label>
				<input type="text" name="title" class="form-control" value="{{old('title')}}" required>
			</div>
			<div class="col-md-2 form-group">
				<label for="priority"> اولویت </label>
				<select class="form-control" name="priority" id="priority">
					<option value="1" @if(old('priority') == 1) selected @endif> پایین </option>
					<option value="2" @if(old('priority') == 2) selected @endif> متوسط </option>
					<option value="3" @if(old('priority') == 3) selected @endif> بالا </option>
				</select>
			</div>
			<div class="col-md-2 form-group">
				<label for="type"> نوع نامه </label>
				<select class="form-control" name="type" id="type">
					<option value="official" @if(old('type') == 'official') selected @endif> اداری </option>
					<option value="complaint" @if(old('type') == 'complaint') selected @endif> شکایت </option>
				</select>
			</div>
			<div class="col-md-3 form-group">
				<label for="file"> ضمیمه کردن فایل </label>
				<input type="file" name="file" class="form-control">
			</div>

			<div class="col-md-12 form-group">
				<label for="body"> متن نامه </label>
				<textarea name="body" id="body" rows="8" class="form-control" required>{{old('body')}}</textarea>
			</div>

			<div class="col-md-2 form-group">
				<button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-check ml-1"></i> تایید </button>
			</div>

		</form>

	</div>
@endsection
