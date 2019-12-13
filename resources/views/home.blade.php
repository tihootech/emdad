@extends('layouts.dashboard')

@section('main')


    @root

        <div class="tile">
            <table class="table table-bordered table-hover table-striped table-responsive-lg">
                <thead>
                    <tr>
                        <th> ردیف </th>
                        <th> مددکار </th>
                        <th> منطقه </th>
                        <th> تعداد ثبت مددجو </th>
                        <th> تعداد معرفی مددجو </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operators as $i => $operator)
                        <tr>
                            <th> {{$i+1}} </th>
                            <td> {{$operator->full_name()}} </td>
                            <td> {{$operator->region}} </td>
                            <td> {{$operator->madadjus->count()}} </td>
                            <td> {{$operator->introduces->count()}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
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
                                        <a href="{{url('owners/operator')}}" class="btn btn-outline-light mx-1">
                                            <i class="fa fa-user-secret ml-1"></i>
                                            مدیریت مددکارها
                                        </a>
                                        <a href="{{url('owners/organ')}}" class="btn btn-outline-light mx-1">
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
    @endroot

    @only_organ
        @if ($user->owner->fresh_introduces->count())
            <div class="tile mt-4">
                <h4 class="mb-4"> لیست افراد معرفی شده جدید </h4>
                @include('introduces.table', ['introduces'=>$user->owner->fresh_introduces])
            </div>
        @endif
    @endonly_organ

    @operator
        @if ($rejects->count())
            <div class="tile mt-4">
                <h5 class="mb-4"> مددجویان رد شده توسط مووسات </h5>
                @foreach ($rejects as $introduce)
                    <div class="card my-3">

                        <div class="card-body">
                            <a href="{{url("madadju/$introduce->madadju_id")}}" class="mx-1"> {{$introduce->madadju->full_name()}} </a>
                            که در تاریخ
                            <em class="text-info mx-1"> {{human_date($introduce->created_at)}} </em>
                            به موسسه
                            <b class="text-info mx-1"> {{$introduce->organ->name ?? '-'}} </b>
                            معرفی شده بود، توسط این موسسه رد شد.
                            علت رد شدن : <span class="text-danger"> {{$introduce->information}} </span>
                        </div>
                        <div class="card-footer">
                            <form class="text-left" action="{{url("introduce/confirm/$introduce->id")}}" method="post">
                                @csrf
                                <button type="submit" name="confirmed" value="1" class="btn btn-outline-success btn-sm mr-2" data-toggle="popover" data-content="با تایید درخواست این موسسه وضعیت شخص به رد شده تغییر پیدا میکند." data-trigger="hover" data-placement="top">
                                    <i class="fa fa-check ml-1"></i>
                                </button>
                                <button type="submit" name="confirmed" value="0" class="btn btn-outline-danger btn-sm mr-2" data-toggle="popover" data-content="با رد کرد درخواست این موسسه وضعیت شخص به تایید شده بازمیگردد" data-trigger="hover" data-placement="top">
                                    <i class="fa fa-times ml-1"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    @endoperator

@endsection
