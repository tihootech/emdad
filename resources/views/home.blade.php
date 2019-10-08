@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title"> میانبر ها </h5>
                        <hr>
                        <a href="{{url('madadjus')}}" class="btn btn-primary mx-1"> مدیریت مدد جویان </a>
                        <a href="{{url('')}}" class="btn btn-primary mx-1"> مدیریت ارگان ها </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
