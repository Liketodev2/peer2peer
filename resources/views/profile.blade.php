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
            <div class="">
                <h1 class="title">Profile</h1>
                <div class="d-flex p-4">
                    <img class="img-fluid prof-img mr-4" alt="" style="background-image: url({{ $user->avatar ? asset('images').'/'.$user->avatar : asset('img').'/profile-user-gray.svg'}})">
                    <div>
                        @if($user->type == 20)
                            <div class="name">{{$user->first_name}}</div>
                            <div class="username mb-3">{{$user->last_name}}</div>
                        @else
                            <div class="name">{{$user->company_name}}</div>
                        @endif
                            <div class="d-flex">
                                <div><i class="fas fa-users"></i> Followers: {{$user->followers()->count()}}</div>
                            </div>
                            <div class="d-flex">
                                <div><i class="far fa-eye"></i> Following: {{$user->following()->count()}}</div>
                            </div>
                            @if($user->type == 10)
                                <div class="d-flex">
                                    <div><i class="fas fa-rss-square pr-1"></i> RSS: {{$rss_count}}</div>
                                </div>
                            @endif
                        @if(\Auth::user() && \Auth::id() != $user->id)
                            <div class="d-flex mt-4">
                                <div class="follow-check" style="{{Auth::user()->follow_action() && Auth::user()->follow_action()->where('follow_id', $user->id)->first() ? 'display:block': 'display:none' }}"><i class="far fa-check-circle text-success mr-2"></i></div>
                                @if($user->type == 10)
                                    <button class="btn-red mr-3 w-90 follow-btn" data-follow="{{$user->id}}">Follow</button>
                                @endif
                                <a href="{{route('add-conversation', $user->id)}}"><div role="button" class="chat-btn"></div></a>
                            </div>
                        @endif

                    </div>
                    @if($user->type == 10)
                            <div class="ml-4">
                                <div class="name">Channels</div>
                                @foreach($my_channels as $channel)
                                <a href="{{route('profile', $channel->id)}}">{{$channel->company_name}}</a>
                                @endforeach
                            </div>
                    @endif
                </div>

            </div>
            <h1 class="title mt-4">Feeds</h1>
            <div class="color-gray my-3">
                Founded {{$results_count}} results
            </div>
            <div class="">
                <div class="card-body">
                    @foreach($results as $result)
                        <div class="d-flex row-news">
                            <div class="w-40"><a href="{{route('feed', $result->id)}}">{{$result->title}}</a></div>
                            <div class="mx-auto flex-1 d-flex justify-content-center">{{$result->category->name}}</div>
                            <div class="mx-auto flex-1 d-flex pl-4">{{$result->user->type == 10 ? $result->user->company_name : $result->user->first_name .' '. $result->user->last_name}}</div>
                            <div class="mx-auto flex-1 d-flex justify-content-center">{{\Carbon\Carbon::parse($result->created_at)->format('D, M d H:i')}}</div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    {{$results->links('pagination::bootstrap-4')}}
                </div>
            </div>
            <h1 class="title mt-4">Reposts</h1>
            <div class="color-gray my-3">
                Founded {{$reposts_count}} results
            </div>
            <div class="">
                <div class="card-body">
                    @foreach($reposts as $result)
                        <div class="d-flex row-news">
                            <div class="w-40"><a href="{{route('feed', $result->id)}}">{{$result->title}}</a></div>
                            <div class="mx-auto flex-1 d-flex justify-content-center">{{$result->category->name}}</div>
                            <div class="mx-auto flex-1 d-flex pl-4">{{$result->user->type == 10 ? $result->user->company_name : $result->user->first_name .' '. $result->user->last_name}}</div>
                            <div class="mx-auto flex-1 d-flex justify-content-center">{{\Carbon\Carbon::parse($result->created_at)->format('D, M d H:i')}}</div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    {{$reposts->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>

@endsection
