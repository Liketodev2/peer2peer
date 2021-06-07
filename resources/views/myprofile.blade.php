@extends('layouts.main')
@section('content')

    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <div class="flex-1 profile-content p-4">
            <div class="my-profile-content">
                <h1 class="title">My Profile</h1>
                <div class="d-flex align-items-center p-4">
                    <div class="mr-4 prof-img">
                        <div class="upload-img">
                            <div class="d-flex justify-content-center align-items-center w-100 h-100">
                                <img src="{{asset('img/Group%20103.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div>

                        @if($user->type == 20)
                            <div class="d-flex justify-content-between ">
                                <div class="name">{{$user->first_name}} </div>
                                <i class="fas fa-pencil-alt ml-5"></i>
                            </div>
                            <div class="username mb-3">{{$user->last_name}}</div>
                        @else
                            <div class="name">{{$user->company_name}}</div>
                        @endif
                        <div class="d-flex">
                            <div><i class="far fa-envelope color-red mr-1"></i>{{$user->email}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>

@endsection
