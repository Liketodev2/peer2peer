@extends('layouts.main')
@section('content')
    <div class="d-xl-flex ">
        @include('areas.my-feed-left-side')
        <main class="flex-1 main-content">
            <div class="accordion p-lg-5" id="accordionExample">
                <div class="d-flex mb-4">
                    <div class="mr-3">Don`t display in category</div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="comment_access" data-show="{{$user->id}}" class="custom-control-input show-category" id="customSwitch1" {{Auth::user()->showCategory_action() && Auth::user()->showCategory_action()->where('blocked_id', $user->id)->first()  ? 'checked': '' }}>
                        <label class="custom-control-label" for="customSwitch1"></label>
                    </div>
                </div>
                @foreach($feeds as $key => $feed)
                    <div class="card alert alert-dismissible fade show">
                        <div class="card-header" id="heading{{$loop->index}}">
                            <button class="btn btn-link" type="button">
                                {{ $key }}
                            </button>
                            {{--    <ul class="d-flex">
                                    <li class="active"><a href="#">Mixed</a></li>
                                    <li><a href="#">Recommended</a></li>
                                    <li><a href="#">Followed</a></li>
                                </ul>--}}
                            <div class="d-flex flex-1 justify-content-end abs">
                                <div class="mr-3" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="true" aria-controls="collapse{{$loop->index}}"><img class="toggle_triangle rotate" src="{{asset('img/Path%2047.svg')}}" alt="img"></div>
                                <div data-dismiss="alert" aria-label="Close"><img src="{{asset('img/x-blue.svg')}}" alt="img"></div>
                            </div>
                        </div>
                        <div id="collapse{{$loop->index}}" class="collapse show" aria-labelledby="heading{{$loop->index}}" data-parent="#accordionExample">
                            <div class="card-body">
                                @if(count($feed) > 0)
                                    @foreach($feed as $feed_item)
                                        <div class="d-flex row-news">
                                            <div class="w-40"><a href="{{route('feed',$feed_item->id)}}">{{$feed_item->title}}</a></div>
                                            <div class="flex-1">{{$feed_item->user->company_name ? $feed_item->user->company_name : $feed_item->user->first_name.' '. $feed_item->user->last_name}}</div>
                                            <div class="flex-1">{{$feed_item->category->name}}</div>
                                            <div class="flex-1">{{\Carbon\Carbon::parse($feed_item->created_at)->format('H:i')}}</div>
                                        </div>
                                    @endforeach
                                @else
                                    Feeds are empty
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </main>
        @include('areas.feed-right-side')
    </div>
@endsection
