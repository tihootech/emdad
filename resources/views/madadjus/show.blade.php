@extends('layouts.dashboard')
@section('main')

	@operator
		<div class="tile">
			<h4 class="mb-4 text-info"> <i class="fa fa-history ml-1"></i> تاریخچه شخص </h4>
			<hr>
			@if ($madadju->introduces->count())
				<ul>
					@foreach ($madadju->introduces as $introduce)
						<li class="my-2">
							در تاریخ
							<b class="text-info mx-1"> {{human_date($introduce->crated_at)}} </b>
							به موسسه
							<b class="text-info mx-1"> {{$introduce->organ->agency_name ?? '-'}} </b>
							معرفی شد و این موسسه
							@if ($introduce->status == 1)
								<b class="text-secondary mx-1"> هنوز وضعیت شخص را مشخص نکرده است. </b>
							@elseif ($introduce->status == 2)
								<b class="text-success mx-1"> شخص را در تاریخ {{human_date($introduce->updated_at)}} تایید کرد. </b>
							@elseif ($introduce->status == 3)
								<b class="text-danger mx-1"> شخص را رد کرد ({{$introduce->information}}) </b>
							@endif
							@unless ($introduce->confirmed)
								<span class="text-info mx-1"> لازم به ذکر است که هنوز وضعیت این شخص توسط مددکارها تایید نشده است. </span>
							@endunless
						</li>
					@endforeach
				</ul>
			@else
				<div class="alert alert-warning">
					هنوز برای این شخص تاریخچه ای ایجاد نشده است.
				</div>
			@endif
		</div>
	@endoperator

	<div class="tile">
		<h4 class="mb-4 text-info"> <i class="fa fa-list ml-1"></i> مشخصات </h4>
		<hr>
		<div class="row justify-content-center">
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> نام و نام خانوادگی : </b> <span class="text-info"> {{$madadju->full_name()}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> کدملی : </b> <span class="text-info"> {{$madadju->national_code ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> تاریخ تولد : </b> <span class="text-info"> {{date_picker_date($madadju->birthday)}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-2 my-2">
				<div class="card">
					<div class="card-body">
						<b> سن : </b> <span class="text-info"> {{$madadju->age()}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-2 my-2">
				<div class="card">
					<div class="card-body">
						<b> جنسیت : </b> <span class="text-info"> {{$madadju->male ? 'مرد' : 'زن'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> مقطع تحصیلی : </b> <span class="text-info"> {{$madadju->education_grade ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> رشته تحصیلی : </b> <span class="text-info"> {{$madadju->education_field ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> شماره بیمه : </b> <span class="text-info"> {{$madadju->insurance_number ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-12 my-2">
				<div class="card">
					<div class="card-body">
						<b> علاقه مندی ها : </b> <span class="text-info"> {{$madadju->favourites ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-12 my-2">
				<div class="card">
					<div class="card-body">
						<b> مهارت : </b> <span class="text-info"> {{$madadju->skill ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-12 my-2">
				<div class="card">
					<div class="card-body">
						<b> آموزش : </b> <span class="text-info"> {{$madadju->training ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> تلفن : </b> <span class="text-info"> {{$madadju->telephone ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> موبایل : </b> <span class="text-info"> {{$madadju->mobile ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> وضعیت تاهل : </b> <span class="text-info"> {{$madadju->married ? 'متاهل' : 'مجرد'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> وضعیت نظام وظیفه : </b> <span class="text-info"> {{$madadju->military_status ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> نام و نام خانوادگی سرپرست : </b> <span class="text-info"> {{$madadju->warden_name ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> کدملی سرپرست : </b> <span class="text-info"> {{$madadju->warden_national_code ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> کد مددجویی : </b> <span class="text-info"> {{$madadju->muid ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-12 my-2">
				<div class="card">
					<div class="card-body">
						<b> آدرس : </b> <span class="text-info"> {{$madadju->address ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-12 my-2">
				<div class="card">
					<div class="card-body">
						<b> تجربه : </b>
						<span class="text-info">
							{{$madadju->work_experience ? 'بلی' : 'خیر'}}
							@if ($madadju->work_experience && $madadju->experience)
								({{$madadju->experience}})
							@endif
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	@operator
		<div class="tile">
			<h4 class="mb-4 text-info"> <i class="fa fa-tasks ml-1"></i> عملیات </h4>
			<hr>
			<a href="{{url("madadju/$madadju->id/edit")}}" class="btn btn-outline-success mx-2"> <i class="fa fa-edit ml-1"></i> ویرایش </a>
			@include('partials.delete', ['key' => 'madadju', 'dtype'=>'text'])
		</div>
	@endoperator

@endsection
