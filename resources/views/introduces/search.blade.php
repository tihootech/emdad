<form id="searchbox" class="collapse" autocomplete="off">

	<hr>

	<div class="row justify-content-center">
		<div class="col-md-4 form-group">
			<label for="madadju"> جستجو بر اساس مددجو </label>
			<select class="select2" name="madadjus[]" id="madadju" multiple>
				@foreach ($madadjus as $madadju)
					<option value="{{$madadju->id}}" @if( in_array($madadju->id, request('madadjus') ?? []) ) selected @endif>
						{{$madadju->full_name()}} - {{$madadju->national_code}}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-4 form-group">
			<label for="organ"> جستجو بر اساس موسسه </label>
			<select class="select2" name="organs[]" id="organ" multiple>
				@foreach ($organs as $organ)
					<option value="{{$organ->id}}" @if( in_array($organ->id, request('organs') ?? []) ) selected @endif>
						{{$organ->name}}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-4 form-group">
			<label for="operator"> جستجو بر اساس مددکار </label>
			<select class="select2" name="operators[]" id="operator" multiple>
				@foreach ($operators as $operator)
					<option @if( in_array($operator->id, request('operators') ?? []) ) selected @endif value="{{$operator->id}}">
						{{$operator->name}}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-4 form-group">
			<label for="status"> وضعیت </label>
			<select class="select2" name="status[]" id="status" multiple>
				<option @if( in_array(1, request('status') ?? []) ) selected @endif value="1"> معلق </option>
				<option @if( in_array(2, request('status') ?? []) ) selected @endif value="2"> تایید شده </option>
				<option @if( in_array(3, request('status') ?? []) ) selected @endif value="3"> رد شده </option>
			</select>
		</div>
		<div class="col-md-8 form-group">
			<label for="from"> تاریخ معرفی </label>
			<div class="form-inline">
				<span class="mx-1"> از </span>
				<input type="text" name="from" class="form-control mx-1 pdp" value="{{request('from')}}" >
				<span class="mx-1"> تا </span>
				<input type="text" name="till" class="form-control mx-1 pdp" value="{{request('till')}}" >
			</div>
		</div>
	</div>

	<hr>
	<div class="text-center">
		<a href="{{url("madadju")}}" class="btn btn-warning mx-1"> <i class="fa fa-times ml-1"></i> لغو جستجو </a>
		<button type="submit" class="btn btn-primary mx-1"> <i class="fa fa-search ml-1"></i> جستجو </button>
	</div>
</form>
