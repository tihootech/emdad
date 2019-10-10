@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="jumbotron">
			<h1> خطا </h1>
			<hr class="my-4">
			<div class="alert alert-danger text-center">
				این صفحه یا وجود ندارد، یا اجازه دسترسی به آن را ندارید.
			</div>
			<hr class="my-4">
			<p class="lead">
				<a class="btn btn-primary" href="{{url("home")}}"> رفتن به داشبورد </a>
			</p>
		</div>
	</div>

@endsection
