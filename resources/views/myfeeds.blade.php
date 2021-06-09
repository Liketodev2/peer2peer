@extends('layouts.main')
@section('content')
    <div class="d-xl-flex my-feed_content">
        <aside class="asides left_aside">
            <div class="pb-4 mb-2 py-3">
                <div class="title px-3">My Feeds</div>
                <div class="bg-white  px-3">
                    Swoeanf Photos
                    Hash2xf043)9432323zf9043 Jasdfasdfasf
                </div>
                <ul class="p-0 active list-unstyled">
                    <li class="active"><a href="#">Followed Feeds</a></li>
                    <li><a href="#">US</a></li>
                    <li><a href="#">World</a></li>
                    <li><a href="#">Politics</a></li>
                    <li><a href="#">Business/Money</a></li>
                    <li><a href="#">Life</a></li>
                    <li><a href="#">Science</a></li>
                    <li><a href="#">Tech</a></li>
                </ul>
            </div>
        </aside>
        <main class="flex-1 main-content">
            @auth
            <div class="col-lg-6 mx-auto">
                <form  action="{{route('feed.store')}}" class="article-form mt-5" method="POST">
                    @csrf
                    <div class="form-title mb-4">
                        Click on an article to start or join a discussion
                    </div>

                    <div class="form-group">
                        <label for="article">Article name</label>
                        <input type="text" required class="form-control @error('article') is-invalid @enderror" name="article" id="article" aria-describedby="article" >
                        @error('article')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="url">URL link of news article</label>
                        <input type="url" required class="form-control @error('url') is-invalid @enderror" name="url" id="url" aria-describedby="emailHelp" >
                        @error('url')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea required name="description" id="description" cols="6" class="w-100 form-control @error('description') is-invalid @enderror" placeholder="Post mini description: 300 characters"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="post_text">Post as</label>
                        <div class="d-flex">
                            <input type="text" required class="form-control mr-2 @error('user_name') is-invalid @enderror" id="post_text" name="user_name" placeholder="Username">
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
                    <div class="form-group d-flex">
                        <label class="mr-4">Comment</label>
                        <div class="d-flex">
                            <div class="mr-3">
                                <input type="radio" id="male" name="comment_access" checked value="1">
                                <label for="male">ON</label>
                            </div>
                            <div>
                                <input type="radio" id="female" name="comment_access" value="0">
                                <label for="female">OFF</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center py-4">
                        <button class="btn-red" role="button">Post</button>
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
                                        <div class=" w-40 text-left"><a href="{{route('feed',$feed_item->id)}}">{{$feed_item->article}}</a></div>
                                        <div class="flex-1 text-center">{{$feed_item->user->company_name ? $feed_item->user->company_name : $feed_item->author_name}}</div>
                                        <div class="flex-1 text-right">{{\Carbon\Carbon::parse($feed_item->created_at)->format('D, M d H:i')}}</div>
                                    </div>
                                @endforeach
                            @else
                                <h4 class="text-danger text-center mt-2">Feeds are empty</h4>
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
                                        <div class=" w-40 text-left"><a href="{{route('feed',$feed_item->id)}}">{{$feed_item->article}}</a></div>
                                        <div class="flex-1 text-center">{{$feed_item->user->company_name ? $feed_item->user->company_name : $feed_item->author_name}}</div>
                                        <div class="flex-1 text-right">{{\Carbon\Carbon::parse($feed_item->created_at)->format('D, M d H:i')}}</div>
                                    </div>
                                @endforeach
                            @else
                                <h4 class="text-danger text-center mt-2">Reposts are empty</h4>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{$reposts->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
        </main>
        <aside class="asides right_aside">
     {{--       <div class="aside-accordion alert p-0">
                <div class="btn btn-red w-100 d-flex justify-content-between align-items-center">
                    <a class="d-flex justify-content-between align-items-center w-100" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                        <div class="title">Profile</div>
                        <img src="img/Polygon%204.png" width="21" height="12">
                    </a>
                    <img src="img/x%20(5).svg" alt="" class="ml-3" data-dismiss="alert" aria-label="Close">
                </div>
                <div class="collapse multi-collapse show" id="multiCollapseExample1">
                    <div class="card card-body">
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="info_name">Feed Name:</div>
                            <div class="info_name-description">Swoeanf Photos</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="info_name">Feed identifier:</div>
                            <div class="info_name-description">Hashn2xf043)</div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </aside>
    </div>
@endsection
