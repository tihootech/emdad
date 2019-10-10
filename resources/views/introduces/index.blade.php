@extends('layouts.dashboard')
@section('main')

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
