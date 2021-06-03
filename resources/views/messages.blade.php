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
        <main class="flex-1 main-content p-2">
            <div class="messages_content">
                <div class="left-group">
                    <div class="form-group mb-0 search-div border-bottom">
                        <label for="search_messages" class="d-flex align-items-center">
                            <i class="fa fa-search mr-2"></i>
                            <input type="search" class="form-control" id="search_messages" placeholder="Search message">
                        </label>
                    </div>
                    <div class="messages_content-item border-bottom">
                        <div class="answer mb-2">The Best Answers</div>
                        <div class="name">John Smit</div>
                        <div class="date">Sep 15</div>
                    </div>
                    <div class="messages_content-item active border-bottom">
                        <div class="answer mb-2">The Best Answers</div>
                        <div class="name">John Smith</div>
                        <div class="date">Sep 15</div>
                    </div>
                    <div class="messages_content-item border-bottom">
                        <div class="answer mb-2">The Best Answers</div>
                        <div class="name">John Smith</div>
                        <div class="date">Sep 15</div>
                    </div>
                    <div class="messages_content-item">
                        <div class="answer mb-2">The Best Answers</div>
                        <div class="name">John Smith</div>
                        <div class="date">Sep 15</div>
                    </div>
                    <div class="messages_content-item border-bottom">
                        <div class="answer mb-2">The Best Answers</div>
                        <div class="name">John Smith</div>
                        <div class="date">Sep 15</div>
                    </div>
                    <div class="messages_content-item">
                        <div class="answer mb-2">The Best Answers</div>
                        <div class="name">John Smith</div>
                        <div class="date">Sep 15</div>
                    </div>
                </div>
                <div class="center-group">
                    <div class="chat-header d-flex align-items-center">
                        <div class="mr-3">
                            <img src="img/profile-user.svg" alt="login">
                        </div>
                        <div>
                            <div class="name mb-1">Lewis Stewart</div>
                            <div class="date">Sep 15, 2016</div>
                        </div>
                    </div>
                    <div class="chat-content pt-3 pb-5">
                        <div class="user_chat col-9 mr-auto mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="name">Lewis Stewart</div>
                                <div class="time">9:52 AM</div>
                            </div>
                            <div class="bg-light">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </div>
                        </div>
                        <div class="user-my_chat col-9 ml-auto mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="name">Lewis Stewart</div>
                                <div class="time">9:52 AM</div>
                            </div>
                            <div class="bg-dark">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </div>
                        </div>
                        <div class="user_chat col-9 mr-auto mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="name">Lewis Stewart</div>
                                <div class="time">9:52 AM</div>
                            </div>
                            <div class="bg-light">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </div>
                        </div>
                        <div class="chat-textarea col-11 ml-auto pt-4">
                            <form action="" class="w-100">
                                <textarea name="textarea" id="" class="w-100 p-3" rows="5" placeholder="Write reply"></textarea>
                                <div role="button" class="btn-red my-4 d-flex ml-auto">Send Message</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
