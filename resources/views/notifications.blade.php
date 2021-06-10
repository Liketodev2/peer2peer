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
        <main class="flex-1 main-content notification_content px-lg-4 py-5">
            <div class="col-12 col-xl-9">
                <div class="alert bg-light-gray alert-red d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">Tom Smith commented on your post “Trump extradites Robert Mueller to Ecuador”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 2 hours ago</div>
                </div>
                <div class="alert bg-light-gray  d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">-Robert Makerman replied to the comment on post “CNN World is banned from Venezuela”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 4 hours ago</div>
                </div>
                <div class="alert bg-light-gray d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">-Robert Makerman replied to the comment on post “CNN World is banned from Venezuela”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 4 hours ago</div>
                </div>
                <div class="alert bg-light-gray d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">-Robert Makerman replied to the comment on post “CNN World is banned from Venezuela”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 4 hours ago</div>
                </div>
            </div>
        </main>
    </div>
@endsection
