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
            @if(Auth::user()->main == 1 && Auth::user()->parent_id == null)
                <div class="my-profile-content mt-4">
                    <h1 class="title">Profile List</h1>
                    @include('areas.flash')
                    <div class="accordion px-lg-5">
                        <div class="card alert alert-dismissible fade show">
                            <div class="card-header">
                                My Channels
                            </div>
                            <div class="card-body">
                                @if($my_channels->count() > 0)
                                    @foreach($my_channels as $item)
                                        <div class="d-flex">
                                            <div class=" w-40 text-left">{{$item->company_name}}</div>
                                            <div class="flex-1 text-center">{{$item->email}}</div>
                                            <div class="flex-1 text-right">{{\Carbon\Carbon::parse($item->created_at)->format('D, M d H:i')}}</div>
                                            <div class="flex-1 text-right">
                                                <a href="{{route('my-channels.feeds', $item->id)}}"><button class="btn btn-light btn-sm"><i class="fas fa-info"></i></button></a>
                                                <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                                <form action="{{route('remove-profile',$item->id)}}" method="POST" class="d-none admin-remove-form">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    My channels are empty
                                @endif
                            </div>
                            {{--     <div class="d-flex justify-content-center mt-4">
                                     {{$attached_users->links('pagination::bootstrap-4')}}
                                 </div>--}}
                        </div>
                    </div>
                    <div class="collapse multi-collapse show mt-4" >
                        <div class="card card-body">
                            <div class="d-flex justify-content-center">
                                <div style="width: 100%" class="d-inline-block pb-5">
                                    <form action="{{route('create-profile')}}" method="POST">
                                        @csrf
                                        <h5 class="text-left">Create Profile</h5>
                                        <div class="form-group">
                                            <label for="first_name">First name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}">
                                            @if($errors->has('first_name'))
                                                <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}">
                                            @if($errors->has('last_name'))
                                                <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="company_name">Company name</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}">
                                            @if($errors->has('company_name'))
                                                <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                                            @if($errors->has('email'))
                                                <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                            @if($errors->has('password'))
                                                <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                            @if($errors->has('confirm_password'))
                                                <span class="text-danger" role="alert">
                                                   <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                                @enderror
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn-red py-2 ">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @include('areas.feed-right-side')
    </div>

@endsection
