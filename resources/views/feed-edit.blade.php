@extends('layouts.main')
@section('content')
    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content">
            @auth
                <div class="col-lg-6 mx-auto">
                    <form  action="{{route('feed.update', $feed->id)}}" class="article-form mt-5" method="POST">
                        @csrf
                        <div class="form-title mb-4">
                            Click on an article to start or join a discussion
                        </div>

                        <div class="form-group">
                            <label for="article">Article name</label>
                            <input type="text" required class="form-control @error('title') is-invalid @enderror" name="title" value="{{$feed->title}}" id="article" aria-describedby="article" >
                            @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">URL link of news article</label>
                            <input type="url" required class="form-control @error('url') is-invalid @enderror" name="url" value="{{$feed->url}}" id="url" aria-describedby="emailHelp" >
                            @error('url')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea required name="description" id="description" cols="6" class="w-100 form-control @error('description') is-invalid @enderror" placeholder="Post mini description: 300 characters">{{$feed->description}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="post_text">Post as</label>
                            <div class="d-flex">
                                <input type="text" required class="form-control mr-2 @error('user_name') is-invalid @enderror" id="post_text" name="user_name" value="{{$feed->author_name}}" placeholder="Username">
                                @error('user_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                <select required class="category_select @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                    {{--  <option value="1" selected disabled>Category</option>--}}
                                    @foreach($categories as $category)
                                        <option {{$category->id == $feed->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
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
                                    <input type="radio" id="male" name="comment_access" value="1" {{$feed->comment_access == 1 ? 'checked' : ''}}>
                                    <label for="male">ON</label>
                                </div>
                                <div>
                                    <input type="radio" id="female" name="comment_access" value="0" {{$feed->comment_access == 0 ? 'checked' : ''}}>
                                    <label for="female">OFF</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center py-4">
                            <button class="btn-red" role="button">Change</button>
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
        </main>
        @include('areas.feed-right-side')
    </div>
@endsection