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
			<table class="table table-bordered table-hover table-striped table-sm table-responsive-lg">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col"> <i class="fa fa-square-o" data-checked="0" data-check="all"></i> </th>
						<th scope="col"> نام و نام خانوادگی </th>
						<th scope="col"> سن </th>
						<th scope="col"> مهارت و آموزش </th>
						<th scope="col"> وضعیت نظام وظیفه </th>
						<th scope="col"> منطقه </th>
						<th scope="col"> جنسیت </th>
						<th scope="col"> تعداد معرفی </th>
						<th scope="col" colspan="3"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($madadjus as $index => $madadju)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td> <i class="fa fa-square-o" data-checked="0" data-check="{{$madadju->id}}"></i> </td>
							<td class="@if($madadju->introduces->count()) bg-red-light @endif">
								{{$madadju->full_name() }}
							</td>
							<td>{{$madadju->age()}}</td>
							<td>
								<span class="badge {{$madadju->skill ? 'badge-info': 'badge-secondary'}}" data-toggle="popover" data-content="{{$madadju->skill ?? 'تعریف نشده'}}" data-trigger="hover" data-placement="top"> مهارت </span>
								<span class="badge {{$madadju->training ? 'badge-info': 'badge-secondary'}} mr-1" data-toggle="popover" data-content="{{$madadju->training ?? 'تعریف نشده'}}" data-trigger="hover" data-placement="top"> آموزش </span>
							</td>
							<td>{{$madadju->military_status ?? '-'}}</td>
							<td>{{$madadju->region ?? '-'}}</td>
							<td>{{$madadju->male ? 'مرد' : 'زن'}}</td>
							<td @unless($madadju->icount) class="text-success" @endunless>
								{{$madadju->icount ? $madadju->icount : 'صفر'}}
							</td>
							<td align="center">
								<a href="{{url("madadju/$madadju->id")}}" class="btn btn-sm btn-outline-primary" data-toggle="popover" data-content="جزییات" data-trigger="hover" data-placement="top">
									<i class="fa fa-list ml-1"></i>
								</a>
							</td>
							<td align="center">
								<a href="{{url("madadju/$madadju->id/edit")}}" class="btn btn-sm btn-outline-success" data-toggle="popover" data-content="ویرایش" data-trigger="hover" data-placement="top">
									<i class="fa fa-edit ml-1"></i>
								</a>
							</td>
							<td align="center" class="text-center">
								@include('partials.delete', ['key' => 'madadju', 'dtype'=>'hover', 'btn_sm'=>true])
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
