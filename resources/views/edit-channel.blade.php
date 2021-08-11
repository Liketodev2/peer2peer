@extends('layouts.main')
@push('styles')
    <style>
        .prof-img{
            background-size: contain;
        }
    </style>
@endpush
@section('content')
    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <div class="flex-1 profile-content p-4">
            @include('areas.back-btn')
            <div class="my-profile-content">
                <h1 class="title"><button class="btn-secondary btn-sm d-inline-block mr-2 mb-2"><a class="text-white" href="{{route('my-channels')}}">Back</a></button> {{ $user->company_name }} Profile</h1>
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
                                {{--    <i class="fas fa-pencil-alt ml-5"></i>--}}
                            </div>
                            <div class="username mb-3">{{$user->last_name}}</div>
                        @else
                            <div class="name">{{$user->company_name}}</div>
                        @endif
                        <div class="d-flex">
                            <div><i class="far fa-envelope color-red mr-1"></i>{{$user->email}}</div>
                        </div>
                        <div class="d-flex">
                            <div><i class="fas fa-users"></i> Followers: {{$user->followers()->count()}}</div>
                        </div>
                        <div class="d-flex">
                            <div><i class="far fa-eye"></i> Following: {{$user->following()->count()}}</div>
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
                        <div class="d-flex justify-content-center">
                            <div style="max-width: 375px; width: 100%" class="d-inline-block pb-5">
                                <form action="{{route('change-channel-password', $user->id)}}" method="POST">
                                    @csrf
                                    <h5 class="text-left">Update Password</h5>
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
                                </form>
                            </div>
                            <div style="max-width: 375px;margin-left:50px; width: 100%" class="d-inline-block pb-5">
                                <form action="{{route('update-channel-info', $user->id)}}" method="POST">
                                    @csrf
                                    <h5 class="text-left">Update Info</h5>
                                    <input type="hidden" name="type" value="{{$user->type == 10 ? 'company' : 'user'}}">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}">
                                        @if($errors->has('first_name'))
                                            <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}">
                                        @if($errors->has('last_name'))
                                            <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    @if($user->type == 10)
                                        <div class="form-group">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{$user->company_name}}">
                                            @if($errors->has('company_name'))
                                                <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                    @endif
                                    <div class="mt-4">
                                        <button type="submit" class="btn-red py-2 ">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{--   <div class="d-flex justify-content-between align-items-center py-2">
                               <div class="info_name">Block list:</div>
                               <div class="info_name-description d-flex justify-content-end">
                                   <a href="#" class="ml-2"><img src="img/visibility.svg" alt=""></a>
                                   <a href="#" class="ml-2"><img src="img/import.png" alt=""></a>
                                   <a href="#" class="ml-2"><img src="img/export.svg" alt=""></a>
                               </div>
                           </div>--}}
                    </div>
                    <div class="card card-body mt-4 " >
                        <div>
                            <form action="{{route('rss.store', $user->id)}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="url">Url</label>
                                    <input type="url" class="form-control" id="url" name="url" placeholder="Add Rss link">
                                    @if($errors->has('url'))
                                        <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('url') }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label >Category</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"> {{$category->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn-success btn-sm ">Update</button>
                                <button class="btn-secondary btn-sm"><a class="text-white" href="{{route('my-channels')}}">Back</a></button>
                            </form>
                            @include('areas.flash')
                        </div>
                        <hr>
                        <div>
                            <div class="card alert alert-dismissible fade show" style="background: #F3F3F3">
                                <div class="card-header mt-4">
                                    Rss List
                                </div>
                                <div class="card-body">
                                    @foreach($rss_feeds as $item)
                                    <div class="d-flex">
                                        <div class=" w-40 text-left">{{$item->url}}</div>
                                        <div class=" w-40 text-left">{{$item->category->name}}</div>
                                        <div class="flex-1 text-right">
                                            <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                            <form action="{{route('rss.delete',$item->id)}}" method="POST" class="d-none admin-remove-form">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>
@endsection
