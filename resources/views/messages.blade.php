@extends('layouts.main')
@push('styles')
    <style>
        .fa-comment-slash{
            font-size: 40px;
            margin: 20px 20px;
        }
        .badge{
            position: absolute;
            right: 0px;
            top: 0px;
        }
        .chat-content{
            overflow-y: scroll;
            height: 500px;
        }
    </style>
@endpush
@section('content')
    <div class="d-xl-flex my-feed_content">
        <aside class="asides left_aside">
           {{-- <div class="pb-4 mb-2 py-3">
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
            </div>--}}
        </aside>
        <main class="flex-1 main-content p-2">
            <div class="messages_content">
                <div class="left-group">
                {{--    <div class="form-group mb-0 search-div border-bottom">
                        <label for="search_messages" class="d-flex align-items-center">
                            <i class="fa fa-search mr-2"></i>
                            <input type="search" class="form-control" id="search_messages" placeholder="Search message">
                        </label>
                    </div>--}}

                    @if($conversations->count() > 0)
                        @foreach($conversations as $conversation)
                                <div class="messages_content-item border-bottom position-relative {{Request::has('id') && Request::get('id') == $conversation->id ? 'active': ''}}">
                                    <a href="{{route('messages',['id' =>  $conversation->id])}}">
                                        <div class="name mb-1">{{$conversation->from_id != \Auth::id() ? \App\Http\Controllers\FunctionController::userTypeName($conversation->from_id) : \App\Http\Controllers\FunctionController::userTypeName($conversation->to_id) }}</div>
                                        <div class="answer mb-2"><i>{{$conversation->messages && $conversation->messages->last() ? \Illuminate\Support\Str::limit($conversation->messages->last()->message, 20,'...') : 'start conversation...'}}</i></div>
                                    </a>

                                    @if($conversation->messages()->count() > 0 && $conversation->messages->last()->seen == 0 && $conversation->messages->last()->to_id == \Auth::id())
                                        <span class="badge badge-success">New</span>
                                    @endif
                                </div>
                        @endforeach
                    @else
                        <div class="messages_content-item border-bottom ">
                            <div class="answer mb-2 text-center">You don`t have any conversations</div>
                            <div class="date text-center"><i class="fas fa-comment-slash"></i></div>
                            <div class="name text-center">You can start conversation from user profile page </div>
                        </div>
                    @endif
              {{--     <div class="messages_content-item">
                        <div class="answer mb-2">The Best Answers</div>
                        <div class="name">John Smith</div>
                        <div class="date">Sep 15</div>
                    </div>--}}
                </div>
                <div class="center-group">
                    @if($chat)
                        <div class="chat-header d-flex align-items-center">
                            <div class="mr-3">
                                <a href="{{route('profile', $person->id)}}">
                                     <img src="{{$person->avatar ? asset('images').'/'.$person->avatar : asset('img').'/profile-user-gray.svg'}}" alt="login">
                                </a>
                            </div>
                            <div>
                                <div class="name mb-1">{{\App\Http\Controllers\FunctionController::userTypeName($person->id)}}</div>
                            </div>
                        </div>
                        <div class="chat-content pt-3 pb-5">

                            @foreach($chat->messages as $message)
                                @if($message->from_id == \Auth::id() )
                                    <div class="user-my_chat col-9 ml-auto mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="name">{{\App\Http\Controllers\FunctionController::userTypeName($message->from_id)}}</div>
                                            <div class="time">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}} <i class="fa fa-trash text-danger ml-2 remove-chat-message" data-id="{{$message->id}}" style="cursor: pointer" aria-hidden="true"></i></div>
                                        </div>
                                        <div class="bg-dark">
                                            {{$message->message}}
                                        </div>
                                    </div>
                                @else
                                    <div class="user_chat col-9 mr-auto mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="name">{{\App\Http\Controllers\FunctionController::userTypeName($message->from_id)}}</div>
                                            <div class="time">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}} </div>
                                        </div>
                                        <div class="bg-light">
                                            {{$message->message}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="chat-textarea col-11 ml-auto pt-4">
                            <div class="w-100 chat-form">
                                <textarea name="message" id="message" class="w-100 p-3" rows="5" placeholder="Type message"></textarea>
                                <input type="hidden" value="{{$conversation_id}}" id="conversation_id">
                                <button class="btn-red my-4 d-flex ml-auto send-message-btn">Send Message</button>
                            </div>
                        </div>
                    @else
                       <div class="text-info text-center d-flex align-items-center  justify-content-center mt-4"><h5>PLEASE SELECT CONVERSATION</h5></div>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
           setTimeout(function () {
               $('.chat-content').scrollTop($('.chat-content')[0].scrollHeight);
           });
        });
    </script>
@endpush
