@extends('layouts.main')
@section('content')

    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <div class="flex-1 profile-content p-4">
            <div class="my-profile-content">
                <h1 class="title">My Profile</h1>
                <div class="d-flex align-items-center p-4">
                    <div class="mr-4 prof-img" style="background-image: url({{ $user->avatar ? asset('images').'/'.$user->avatar : asset('img').'/profile-user-gray.svg'}})">
                        <div class="upload-img">
                            <div class="d-flex justify-content-center align-items-center w-100 h-100">
                                <img id="OpenImgUpload" src="{{asset('img/Group%20103.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <form action="{{route('image-upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="imgupload" name="image" style="display:none"/>
                           {{-- <button class="btn-red mr-3 w-90 follow-btn">Update</button>--}}
                        </form>
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
                <div>
                    @if($errors->has('image'))
                        <div class="error text-danger">{{ $errors->first('image') }}</div>
                    @endif
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>

@endsection
