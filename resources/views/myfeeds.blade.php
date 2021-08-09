@extends('layouts.main')
@section('content')
    <div class="d-xl-flex ">
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
                        <input type="text" required class="form-control @error('article_name') is-invalid @enderror" value="{{old('title')}}" name="article_name" id="article" aria-describedby="article" readonly>
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
                            <input type="text" required class="form-control mr-2 @error('user_name') is-invalid @enderror" value="{{old('user_name')}}" id="post_text" name="user_name" placeholder="Username">
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
                {{--    <div class="d-flex">
                        <div class="mr-3">Comment</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="comment_access" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </div>--}}
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
                <div class="accordion px-lg-5 pt-lg-4">
                    <div class="card alert alert-dismissible fade show">
                        <div class="card-header">
                            My feeds
                        </div>
                        <div class="card-body">
                            @if($feeds->count() > 0)
                                @foreach($feeds as $key => $feed_item)
                                    <div class="d-flex row-news">
                                        <div class=" w-40 text-left"><a href="{{route('feed',$feed_item->id)}}">{{$feed_item->title}}</a></div>
                                        <div class="flex-1 text-center">{{$feed_item->category->name}}</div>
                                        <div class="flex-1 text-right">{{\Carbon\Carbon::parse($feed_item->created_at)->format('D, M d H:i')}}</div>
                                        <div class="flex-1 text-right">
                                            <a href="{{route('feed.edit', $feed_item->id)}}"><button class="btn btn-light btn-sm"><i class="fas fa-edit"></i></button></a>
                                            <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                            <form action="{{route('feed.delete',$feed_item->id)}}" method="POST" class="d-none admin-remove-form">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="mt-2">Feeds are empty</h6>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{$feeds->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
                <div class="accordion px-lg-5">
                    <div class="card alert alert-dismissible fade show">
                        <div class="card-header">
                            My Repost
                        </div>
                        <div class="card-body">
                            @if($reposts->count() > 0)
                                @foreach($reposts as $key => $feed_item)
                                    <div class="d-flex row-news">
                                        <div class=" w-40 text-left"><a href="{{route('feed',$feed_item->id)}}">{{$feed_item->title}}</a></div>
                                        <div class="flex-1 text-center">{{$feed_item->user->company_name ? $feed_item->user->company_name : $feed_item->user->first_name .''.$feed_item->user->last_name}}</div>
                                        <div class="flex-1 text-right">{{\Carbon\Carbon::parse($feed_item->created_at)->format('D, M d H:i')}}</div>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="mt-2">Reposts are empty</h6>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{$reposts->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
        </main>
        @include('areas.feed-right-side')
    </div>
@endsection
