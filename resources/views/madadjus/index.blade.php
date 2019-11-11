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

		@include('madadjus.search')

	</div>

	<div class="tile">
		@if ($madadjus->count())

			@include('madadjus.table', ['check'=>true])

			{{$madadjus->appends($_GET)->links()}}
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
							<option @if(old('organ_id') == $organ->id) selected @endif value="{{$organ->id}}">
								{{$organ->title()}}
							</option>
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
