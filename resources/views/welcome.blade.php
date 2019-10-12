@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="jumbotron">
            <h1 class="h2"> اتوماسیون کاریابی استان کرمانشاه </h1>
            <hr>
            <p> برای ورود به اتوماسیون روی لینک زیر کلیک کنید. </p>
            <p class="lead">
                <a class="btn btn-primary" href="{{route('home')}}" role="button"> ورود به پنل </a>
            </p>
        </div>
    </div>

@endsection
