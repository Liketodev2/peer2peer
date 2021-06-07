@extends('layouts.main')
<style>
    .comment-replay{
        border-left: 5px solid #e91414;
        border-radius: 5px;
        padding: 20px;
        margin-left: 20px;
        display: none;
    }
    .replay, .comment-like{
        cursor: pointer;
    }
    .active-comment{
        color: #44b144;
    }
    .btn-sm{
        min-width: 18px !important;
        height: 36px !important;
    }
</style>
@section('content')
    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content p-3">
            <div class="post-content p-4">
                <div class="title">{{$feed->article}}</div>
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
                        <a href="{{route('profile', $feed->user->id)}}"><img src="{{asset('img/profile-user-gray.svg')}}" alt="" class="mr-3"></a>
                        <input type="hidden" name="feed_id" value="{{ $feed->id }}" />
                        <textarea required name="message" id="message" class="p-3 bg-white w-100"  rows="2" placeholder=""></textarea>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pl-lg-5 my-3">
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
                    @endif
                @endauth
                @guest
                    <h5 class="text-danger mt-4"><i class="fas fa-sign-in-alt"></i> Please login to make comments</h5>
                @endguest
                @if($feed->comment_access == 1)
                    @if($feed->comments)
                    @foreach($feed->comments as $comment)
                        <div class="d-flex my-3 align-items-start border-bottom py-4">
                            <a href="{{route('profile', $comment->user->id)}}"><img src="{{asset('img/profile-user-gray.svg')}}" alt="" class="mr-3"></a>
                            <div class="pt-3">
                                <div class="name">{{$comment->user->first_name}} {{$comment->user->last_name}}</div>
                                <div class="date">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}}</div>
                                <div class="text">
                               {{$comment->message}}
                                    {{--<a href="#" class="ml-3">See more</a>--}}
                                </div>
                                <div class="d-flex comment-like-box" data-id="{{$comment->id}}">
                                    @auth
                                        <div class="color-blue replay " data-id="{{$comment->id}}">Replay</div>
                                    @endauth
                                    <div style="{{!\Auth::user() ? 'pointer-events:none' : ''}}" class="mx-2 comment-type-like comment-like comment-like-trigger {{\Auth::user() &&\Auth::user()->comment_like()->where('comment_id', $comment->id)->first() && \Auth::user()->comment_like()->where('comment_id', $comment->id)->first()->like == 1 ? 'active-comment' : ''}}" data-comment="{{$comment->id}}" data-is_like="1"><i class="fas fa-thumbs-up mr-1"></i><span class="count-area">{{$comment->comment_like() ? $comment->comment_like()->where('like', 1)->count() : 0}}</span></div>
                                    <div style="{{!\Auth::user() ? 'pointer-events:none' : ''}}" class="mx-2 comment-type-diss comment-like comment-like-trigger {{\Auth::user() &&\Auth::user()->comment_like()->where('comment_id', $comment->id)->first() && \Auth::user()->comment_like()->where('comment_id', $comment->id)->first()->like == 0 ? 'active-comment' : ''}}" data-comment="{{$comment->id}}" data-is_like="0"><i class="fas fa-thumbs-down mr-1"></i><span class="count-area">{{$comment->comment_like() ? $comment->comment_like()->where('like', 0)->count() : 0}}</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-replay" data-id="{{$comment->id}}" >
                            <form action="{{route('feed.comment')}}" method="POST">
                                @csrf
                                <div class="d-flex align-items-center my-3">
                                    <img src="{{asset('img/profile-user-gray.svg')}}" alt="" class="mr-3">
                                    <input type="hidden" name="feed_id" value="{{ $feed->id }}" />
                                    <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                    <textarea required name="message" id="message" class="p-3 bg-white w-100"  rows="2" placeholder=""></textarea>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pl-lg-5 my-3">
                                    <button class="btn-red btn-sm px-5" role="button">Send</button>
                                </div>
                            </form>
                            @foreach($comment->replies as $replay)
                                <div class="d-flex my-3 align-items-start border-bottom py-4">
                                    <img src="{{asset('img/profile-user-gray.svg')}}" alt="" class="mr-3">
                                    <div class="pt-3">
                                        <div class="name">{{$replay->user->first_name}} {{$replay->user->last_name}}</div>
                                        <div class="date">{{\Carbon\Carbon::parse($replay->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}}</div>
                                        <div class="text">
                                            {{$replay->message}}
                                            {{--<a href="#" class="ml-3">See more</a>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
