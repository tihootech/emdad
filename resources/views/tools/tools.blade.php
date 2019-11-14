@extends('layouts.dashboard')
@section('main')

	<div class="tile">
		<div class="row justify-content-center">
			<div class="col-md-3 my-2">
				<a href="{{url("tools/duplicate-madadjus")}}" class="btn @if($tool=='duplicate-madadjus') btn-primary @else btn-outline-primary @endif btn-block">
					مددجویان تکراری
				</a>
			</div>
			<div class="col-md-3 my-2">
				<a href="{{url("tools/incomplete-madadjus")}}" class="btn @if($tool=='incomplete-madadjus') btn-primary @else btn-outline-primary @endif btn-block">
					مددجویان با اطلاعات ناقص
				</a>
			</div>
		</div>
	</div>

	<div class="tile">
		@if ($tool == 'duplicate-madadjus')

			@if(count($list))
				@foreach ($list as $national_code => $madadjus)
					<h4 class="my-3 text-danger"> <i class="fa fa-arrow-left ml-2"></i> افراد با کد ملی {{$national_code}} </h4>
					@include('madadjus.table', ['check'=>false])
				@endforeach
			@else
				<div class="alert alert-success">
					<i class="fa fa-check ml-1"></i>
					خوشبختانه 2 مددجو با شماره ملی یکسان در سیستم یافت نشد.
				</div>
			@endif

		@elseif ($tool == 'incomplete-madadjus')
			<div class="row">
				<div class="col-md-3">
					<form class="card">
						<ul class="list-group list-group-flush p-0">
							@foreach ($columns as $column)
								<li class="list-group-item">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="filters[]" class="custom-control-input" id="{{$column}}" value="{{$column}}"
										@if(is_array(request('filters')) && in_array($column,request('filters'))) checked @endif>
										<label class="custom-control-label" for="{{$column}}">
											<span class="mr-2"> @lang($column) </span>
										</label>
									</div>
								</li>
							@endforeach
							<li class="list-group-item">
								<button type="submit" class="btn btn-primary btn-block"> تایید </button>
							</li>
						</ul>
					</form>
				</div>
				<div class="col-md-9">
					@if ($madadjus)
						@if ($madadjus->count())
							@include('madadjus.table', ['check'=>false])
							{{$madadjus->appends($_GET)->links()}}
							<hr>
							<div class="text-center">
								@if (is_array(request('filters')) && in_array('mobile', request('filters')))
									<div class="alert alert-danger">
										<i class="fa fa-alert ml-1"></i>
										اطلاع رسانی از طریق پیامک مقدور نمیباشد.
										(به علت مشخص نبودن شماره موبایل مددجویان)
									</div>
								@else
									<div class="alert alert-warning">
										در این لیست <b class="mx-1"> {{$total_count}} </b> مددجو با اطلاعات ناقص پیدا شد.
									</div>
									<a href="#" class="btn btn-outline-info">
										<i class="fa fa-envelope ml-1"></i>
										اطلاع رسانی از طریق پیامک
										(در حال ساخت)
									</a>
								@endif
							</div>
						@else
							<div class="alert alert-success">
								<i class="fa fa-check ml-1"></i>
								موردی یافت نشد.
							</div>
						@endif
					@else
						<div class="alert alert-info">
							<i class="fa fa-info-circle ml-1"></i>
							با استفاده این ابزار شما میتوانید مددجویانی که اطلاعاتشان ناقص میباشد را پیدا کنید.
							برای استفاده از این ابزار کافی است از ستون سمت راست اطلاعات مورد نیاز خود را تیک بزنید و روی دکمه تایید کلیک کنید.
							<hr>
							<b> مثال :  </b>
							اگر قصد دارید مدجویانی که کدملی یا کدد مددجویی آن ها مشخص نیست را پیدا کنید، کافی است از ستون سمت راست
							"کد ملی"
							و
							"کد مددجویی"
							را تیک بزنید و روی دکمه تایید که در پایین قرار دارد کلیک کنید.
						</div>
					@endif
				</div>
			</div>
		@else
			<div class="alert alert-info">
				لطفا یکی از ابزار های بالا را انتخاب کنید.
			</div>
		@endif
	</div>

@endsection
