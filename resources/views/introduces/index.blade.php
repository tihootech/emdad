@extends('layouts.dashboard')
@section('main')

	@operator
		<div class="tile">
			
			<div class="text-left">
				<a class="btn btn-outline-info mx-1" data-toggle="collapse" href="#searchbox">
					<i class="fa fa-search ml-1"></i>
					جستجوی پیشرفته
				</a>
			</div>

			@include('introduces.search')

		</div>
	@endoperator

	<div class="tile">
		@if ($introduces->count())

			@include('introduces.table')

			{{$introduces->links()}}
		@else
			<div class="alert alert-warning">
				موردی یافت نشد.
			</div>
		@endif
	</div>

@endsection
