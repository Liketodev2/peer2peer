@extends('layouts.main')
<style>
    .comment-replay{
        border-left: 5px solid #e91414;
        border-radius: 5px;
        padding: 20px;
        margin-left: 20px;
        display: none;
    }
    .replay, .comment-like, .delete-comment, .edit-comment{
        cursor: pointer;
    }
    .active-comment{
        color: #44b144;
    }
    .btn-sm{
        min-width: 18px !important;
        height: 36px !important;
    }
    .img-user{
        width: 50px;
        height: 50px;
        border-radius: 25px;
        object-fit: contain;
    }
    .edit-comment-block{
        display:none;
    }
    .edit-comment-btn{
        width: 20%;
        height: 36px;
        vertical-align: top !important;
    }
    .feed-profile-link{
        position: absolute;
        right: 0;
    }
    .title{
        width: 95%;
    }
</style>
@section('content')

    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content p-3">
            <div class="post-content p-4 position-relative">
                <a class="feed-profile-link" title="{{\App\Http\Controllers\FunctionController::userTypeName($feed->user->id)}}" href="{{route('profile', $feed->user->id)}}"><img src="{{$feed->user->avatar ? asset('images').'/'. $feed->user->avatar : asset('img').'/profile-user-gray.svg'}}" alt="" class="mr-3 img-user"></a>
                <div class="title">{{$feed->title}}</div>
                <small><strong>Feed/ID: {{$feed->id}}</strong></small>
                <div class="info-text">
                    {{$feed->description}}
                </div>
                <div>
                    <a href="{{$feed->url}}" class="post-link">{{$feed->url}}</a>
                </div>
                @auth
                    @if($feed->comment_access == 1)
                    <form action="{{route('feed.comment')}}" method="POST">
                         @csrf
                    <div class="d-flex align-items-center my-3">
                        <input type="hidden" name="feed_id" value="{{ $feed->id }}" />
                        <textarea required name="message"  class="p-3 bg-white w-100"  rows="2" placeholder=""></textarea>
                    </div>
                    <div class="d-flex align-items-center justify-content-between my-3">
                        <ul class="list-unstyled m-0 d-flex pl-lg-4 flex-wrap">
                            <li class="mr-3 {{\Auth::user()->likes()->where('feed_id', $feed->id)->first() && \Auth::user()->likes()->where('feed_id', $feed->id)->first()->like == 1 ? 'active' : ''}} like-trigger like" data-is_like="1" data-feed="{{$feed->id}}"><a href="javascript:void(0)"><i class="fas fa-thumbs-up mr-1"></i>Like</a></li>
                            <li class="mr-3 {{\Auth::user()->likes()->where('feed_id', $feed->id)->first() && \Auth::user()->likes()->where('feed_id', $feed->id)->first()->like == 0 ? 'active' : ''}} like-trigger like" data-is_like="0" data-feed="{{$feed->id}}"><a href="javascript:void(0)"><i class="fas fa-thumbs-down mr-1"></i>Dislike</a></li>
                            <li class="mr-3 {{\Auth::user()->agrees()->where('feed_id', $feed->id)->first() && \Auth::user()->agrees()->where('feed_id', $feed->id)->first()->agree == 1 ? 'active' : ''}} agree-trigger agree " data-is_agree="1" data-feed="{{$feed->id}}"><a href="javascript:void(0)"><i class="far fa-check-circle mr-1"></i>Agree</a></li>
                            <li class="mr-3 {{\Auth::user()->agrees()->where('feed_id', $feed->id)->first() && \Auth::user()->agrees()->where('feed_id', $feed->id)->first()->agree == 0 ? 'active' : ''}} agree-trigger agree" data-is_agree="0" data-feed="{{$feed->id}}"><a href="javascript:void(0)"><i class="far fa-times-circle mr-1"></i>Disagree</a></li>
                            @if($feed->user_id != \Auth::id())
                            <li class="mr-3 {{\Auth::user()->reposts()->where('feed_id', $feed->id)->first() ? 'active' : ''}} repost-trigger repost" data-feed="{{$feed->id}}"><a href="javascript:void(0)"><i class="fas fa-retweet mr-1"></i>Repost</a></li>
                            @endif
                        </ul>
                        <button class="btn-red px-5" role="button">Send</button>
                    </div>
                </form>
                @if( count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @endif
                @endauth
                @guest
                    <h5 class="text-danger mt-4"><i class="fas fa-sign-in-alt"></i> Please login to make comments</h5>
                @endguest
                @if($feed->comment_access == 1)
                    @if($feed->comments)
                        @foreach($feed->comments as $comment)
                            <div class="comment-block" data-id="{{$comment->id}}" data-type="comment">
                                <div class="d-flex my-3 align-items-start border-bottom py-4 ">
                                    <a href="{{route('profile', $comment->user->id)}}"><img src="{{$comment->user->avatar ? asset('images').'/'.$comment->user->avatar : asset('img').'/profile-user-gray.svg'}}" alt="" class="mr-3 img-user"></a>
                                    <div class="pt-3">
                                        <div class="name">{{\App\Http\Controllers\FunctionController::userTypeName($comment->user->id)}}</div>
                                        <div class="date">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}}</div>
                                        <div class="text edited-text" data-id="{{$comment->id}}">
                                            {{$comment->message}}
                                            {{--<a href="#" class="ml-3">See more</a>--}}
                                        </div>
                                        <div class="d-flex flex-column comment-like-box" data-id="{{$comment->id}}">
                                            <div class=" d-flex align-items-center mb-2">
                                                @auth
                                                    <div class="color-blue replay " data-id="{{$comment->id}}">Reply ({{$comment->replies->count()}})</div>
                                                @endauth
                                                <div style="{{!\Auth::user() ? 'pointer-events:none' : ''}}" class="mx-2 comment-type-like comment-like comment-like-trigger {{\Auth::user() &&\Auth::user()->comment_like()->where('comment_id', $comment->id)->first() && \Auth::user()->comment_like()->where('comment_id', $comment->id)->first()->like == 1 ? 'active-comment' : ''}}" data-comment="{{$comment->id}}" data-is_like="1"><i class="fas fa-thumbs-up mr-1"></i><span class="count-area">{{$comment->comment_like() ? $comment->comment_like()->where('like', 1)->count() : 0}}</span></div>
                                                <div style="{{!\Auth::user() ? 'pointer-events:none' : ''}}" class="mx-2 comment-type-diss comment-like comment-like-trigger {{\Auth::user() &&\Auth::user()->comment_like()->where('comment_id', $comment->id)->first() && \Auth::user()->comment_like()->where('comment_id', $comment->id)->first()->like == 0 ? 'active-comment' : ''}}" data-comment="{{$comment->id}}" data-is_like="0"><i class="fas fa-thumbs-down mr-1"></i><span class="count-area">{{$comment->comment_like() ? $comment->comment_like()->where('like', 0)->count() : 0}}</span></div>
                                                @if(\Auth::id() == $comment->user_id)
                                                    <div class="mr-2 mt-1 edit-comment" data-id="{{$comment->id}}"> <i class="fas fa-edit"></i></div>
                                                    <div class="delete-comment" data-type="comment" data-id="{{$comment->id}}" data-parent="{{$comment->id}}"><i class="fa fa-trash text-danger mt-1" aria-hidden="true"></i></div>
                                                @endif
                                            </div>
                                            <div class="edit-comment-block" data-id="{{$comment->id}}">
                                                <input type="text" name="edited_text" class="edited_text form-control d-inline-block " style="width:70%" value="{{$comment->message}}">
                                                <button class="btn btn-xs  btn-secondary ml-1 edit-comment-btn d-inline-block"  data-id="{{$comment->id}}">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-replay w-100" data-id="{{$comment->id}}" >
                                    @auth
                                    <form action="{{route('feed.comment')}}" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center my-3">
                                            <img src="{{\Auth::user()->avatar ? asset('images').'/'.\Auth::user()->avatar : asset('img').'/profile-user-gray.svg'}}" alt="" class="mr-3 img-user">
                                            <input type="hidden" name="feed_id" value="{{ $feed->id }}" />
                                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                            <input type="hidden" name="reply" value="1">
                                            <textarea required name="message"  class="p-3 bg-white w-100"  rows="2" placeholder=""></textarea>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between pl-lg-5 my-3">
                                            <button class="btn-red btn-sm px-5" role="button">Send</button>
                                        </div>
                                    </form>
                                    @endauth
                                    @if( count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @foreach($comment->replies as $replay)
                                        <div class="comment-block" data-id="{{$replay->id}}" data-type="reply">
                                            <div class="d-flex my-3 align-items-start border-bottom py-4 " >
                                                <a href="{{route('profile',$replay->user->id)}}"><img src="{{$replay->user->avatar ? asset('images').'/'.$replay->user->avatar : asset('img').'/profile-user-gray.svg'}}" alt="" class="mr-3 img-user"></a>
                                                <div class="pt-3">
                                                    <div class="name">{{\App\Http\Controllers\FunctionController::userTypeName($replay->user->id)}}</div>
                                                    <div class="date">{{\Carbon\Carbon::parse($replay->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}}</div>

                                                    <div class="text edited-text" data-id="{{$replay->id}}">
                                                        {{$replay->message}}
                                                        {{--<a href="#" class="ml-3">See more</a>--}}
                                                    </div>
                                                    @if(\Auth::id() == $replay->user_id)
                                                        <div class="d-flex">
                                                            <div class="delete-comment mt-1 d-inline-block mr-2" data-type="reply" data-id="{{$replay->id}}" data-parent="{{$replay->id}}"><i class="fa fa-trash text-danger" aria-hidden="true"></i></div>
                                                            <div class="mr-2 mt-1 edit-comment" data-id="{{$replay->id}}"> <i class="fas fa-edit"></i></div>
                                                        </div>
                                                        <div class="edit-comment-block mt-1" data-id="{{$replay->id}}">
                                                            <input type="text" name="edited_text" class="edited_text form-control d-inline-block " style="width:70%" value="{{$replay->message}}">
                                                            <button class="btn btn-xs  btn-secondary ml-1 edit-comment-btn d-inline-block"  data-id="{{$replay->id}}">Edit</button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                            <div class="d-flex justify-content-end">
                                <div role="button" class="color-red btn-link">Show more comments >></div>
                            </div>
                    @endif
                @endif
                @if($feed->comment_access == 0 && !\Auth::guest())
                    <h5 class="text-info mt-4"><i class="far fa-times-circle"></i> Comments disabled by the author</h5>
                @endif
            </div>
        </main>
        @include('areas.feed-right-side')
    </div>
@endsection
