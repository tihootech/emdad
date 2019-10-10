@extends('layouts.dashboard')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card text-white bg-info">
                        <div class="card-header">
                            <h3> میانبر ها </h3>
                        </div>
                        <div class="card-body">
                            @operator
                                @master
                                    <a href="{{url('users/operator')}}" class="btn btn-outline-light mx-1">
                                        <i class="fa fa-user-secret ml-1"></i>
                                        مدیریت متصدیان
                                    </a>
                                    <a href="{{url('users/organ')}}" class="btn btn-outline-light mx-1">
                                        <i class="fa fa-bank ml-1"></i>
                                        مدیریت موسسات
                                    </a>
                                    <hr>
                                @endmaster
                                <a href="{{url('madadju')}}" class="btn btn-outline-light mx-1">
                                    <i class="fa fa-male ml-1"></i>
                                    مدیریت مدد جویان
                                </a>
                            @endoperator
                            @only_organ
                                <a href="{{url('introduce')}}" class="btn btn-outline-light mx-1">
                                    <i class="fa fa-list ml-1"></i>
                                    لیست کامل افراد معرفی شده
                                </a>
                            @endonly_organ
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @only_organ
        @if ($user->fresh_introduces->count())
            <div class="tile mt-4">
                @include('introduces.table', ['introduces'=>$user->fresh_introduces])
            </div>
        @endif
    @endonly_organ

@endsection
