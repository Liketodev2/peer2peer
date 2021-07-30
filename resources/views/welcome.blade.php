@extends('layouts.main')
@section('content')
    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content">
            @auth
                <div class="col-lg-6 mx-auto">
                    <form  action="{{route('feed.store')}}" class="article-form mt-5" method="POST">
                        @csrf
                        <div class="form-title mb-4">
                            Click on an article to start or join a discussion
                        </div>
                        <div class="form-group">
                            <label for="url">URL link of news article</label>
                            <input type="url" required class="form-control @error('url') is-invalid @enderror" value="{{old('url')}}" name="url" id="url" aria-describedby="emailHelp" >
                            @error('url')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="article">Article name</label>
                            <input type="text" required class="form-control @error('article_name') is-invalid @enderror" name="article_name" id="article" value="{{old('title')}}" aria-describedby="article" readonly>
                            @error('article_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea required name="description" id="description" cols="6" class="w-100 form-control @error('description') is-invalid @enderror" placeholder="Post mini description: 300 characters">{{old('description')}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="post_text">Post as</label>
                            <div class="d-flex">
                                <input type="text" required class="form-control mr-2 @error('user_name') is-invalid @enderror" id="post_text" value="{{old('user_name')}}" name="user_name" placeholder="Username">
                                @error('user_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                <select required class="category_select @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                    {{--  <option value="1" selected disabled>Category</option>--}}
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post_text">Discussion size</label>
                            <div class="d-flex">
                                <select required class="form-control discussion_count @error('discussion_count') is-invalid @enderror" name="discussion_count" id="discussion_count">
                                    @for($i = 6; $i < 13; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                @error('discussion_count')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
{{--                        <div class="form-group d-flex">--}}
{{--                            <label class="mr-4">Comment</label>--}}
{{--                            <div class="d-flex">--}}
{{--                                <div class="mr-3">--}}
{{--                                    <input type="radio" id="male" name="comment_access" value="1" checked>--}}
{{--                                    <label for="male">ON</label>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <input type="radio" id="female" name="comment_access" value="0">--}}
{{--                                    <label for="female">OFF</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="d-flex">
                            <div class="mr-3">Comment</div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="comment_access" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center py-4">
                            <button class="btn-red post-feed-btn" role="button">Post</button>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </form>
                </div>
            @endauth
            <div class="accordion p-lg-5" id="accordionExample">
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
                                    <div class="mr-3" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="true" aria-controls="collapse{{$loop->index}}"><img src="{{asset('img/Path%2047.svg')}}" alt="img"></div>
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
