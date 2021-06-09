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
                            <div class="d-flex">
                                <div><i class="fas fa-users"></i> Followers: {{\Auth::user()->followers()->count()}}</div>
                            </div>
                            <div class="d-flex">
                                <div><i class="far fa-eye"></i> Following: {{\Auth::user()->following()->count()}}</div>
                            </div>
                    </div>
                </div>
                <div>
                    @if($errors->has('image'))
                        <div class="error text-danger">{{ $errors->first('image') }}</div>
                    @endif
                </div>
                <div class="collapse multi-collapse show mt-4" >
                    <div class="card card-body">
                        <div>
                            <form action="{{route('change-password')}}" method="POST">
                                @csrf
                                <div style="max-width: 375px; width: 100%" class=" pb-5">
                                    <h3 class="text-left">Update Password</h3>
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                        @if($errors->has('current_password'))
                                        <span class="text-danger" role="alert">
                                               <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                        @if($errors->has('new_password'))
                                        <span class="text-danger" role="alert">
                                               <strong>{{ $errors->first('new_password') }}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_new_password">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
                                        @if($errors->has('confirm_new_password'))
                                        <span class="text-danger" role="alert">
                                               <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn-red py-2 ">Update</button>
                                    </div>
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-block mt-2">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="info_name">Block list:</div>
                            <div class="info_name-description d-flex justify-content-end">
                                <a href="#" class="ml-2"><img src="img/visibility.svg" alt=""></a>
                                <a href="#" class="ml-2"><img src="img/import.png" alt=""></a>
                                <a href="#" class="ml-2"><img src="img/export.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>

@endsection
