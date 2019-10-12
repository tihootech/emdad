<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col"> مددجو </th>
			@operator
				<th scope="col"> موسسه معرفی شده </th>
				<th scope="col"> متصدی معرفی کننده </th>
			@endoperator
			<th scope="col"> وضعیت </th>
			<th scope="col"> تاریخ معرفی </th>
			<th scope="col"> عملیات </th>
		</tr>
	</thead>
	<tbody>
		@foreach ($introduces as $index => $introduce)
			<tr>
				<th scope="row">{{$index+1}}</th>
				<td>
					@if ($introduce->madadju)
						<a href="{{url("madadju/$introduce->madadju_id")}}"> {{$introduce->madadju->full_name()}} </a>
					@else
						<em> حذف شده </em>
					@endif
				</td>
				@operator
					<td> {{$introduce->organ ? $introduce->organ->name : '-'}} </td>
					<td> {{$introduce->operator ? $introduce->operator->name : '-'}} </td>
				@endoperator
				<td @if($introduce->information) data-toggle="popover" data-content="{{$introduce->information}}" data-trigger="hover" data-placement="top" @endif class="@if($introduce->status == 1) text-warning @elseif($introduce->status == 2) text-success @else text-danger @endif" >
					{{$introduce->status_name()}}
				</td>
				<td> {{date_picker_date($introduce->created_at)}} </td>
				@operator
					@if ($introduce->status == 1)
						<td class="text-center">
							<form action="{{url("introduce/$introduce->id")}}" method="post">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-outline-danger">
									<i class="fa fa-times ml-1"></i> لغو معرفی
								</button>
							</form>
						</td>
					@else
						<td> - </td>
					@endif
				@endoperator
				@only_organ
					<td>
						<form action="{{url("introduce/status/$introduce->id")}}" method="post">
							@csrf
							<div class="row">
								<div class="col-md-8">
									<select class="form-control" name="status" id="status">
										<option value="1" @if($introduce->status == 1) selected @endif > معلق </option>
										<option value="2" @if($introduce->status == 2) selected @endif > تایید کردن </option>
										<option value="3" @if($introduce->status == 3) selected @endif > رد کردن </option>
									</select>
								</div>
								<div class="col-md-4">
									<button type="submit" class="btn btn-outline-success btn-block"> تغییر وضعیت </button>
								</div>
							</div>
							<input type="text" name="information" id="information" class="form-control mt-3 hidden" placeholder="علت رد کردن">

						</form>
					</td>
				@endonly_organ
			</tr>
		@endforeach
	</tbody>
</table>
